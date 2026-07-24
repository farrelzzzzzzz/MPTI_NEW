<?php

namespace App\Http\Controllers;

use App\Services\DistanceService;
use Illuminate\Http\Request;
use App\Services\LocationAliasService;
use App\Services\ChatbotService;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        $message = trim($request->message);

        // Cek apakah pertanyaan tentang lokasi
        $locationAnswer = $this->handleLocationQuery($message);

        if ($locationAnswer !== null) {

            return response()->json([
                'success' => true,
                'answer' => $locationAnswer
            ]);
        }

        $chatbot = app(ChatbotService::class);

        $answer = $chatbot->ask($message);

        return response()->json([
            'success' => true,
            'answer' => $answer
        ]);
    }
    protected function handleLocationQuery(string $message): ?string
    {
        $parsed = $this->parseLocations($message);

        if ($parsed === null) {
            return null;
        }

        [$origin, $destination] = $parsed;

        $locationService = app(LocationAliasService::class);

        $origin = $locationService->normalize($origin);
        $destination = $locationService->normalize($destination);

        $distanceService = app(DistanceService::class);

        $result = $distanceService->calculate(
            $origin,
            $destination
        );

        if ($result['distance_km'] === null) {

            return "Maaf, saya tidak dapat menghitung jarak dari \"{$origin}\" ke \"{$destination}\" saat ini. 😅\n\nSilakan gunakan nama lokasi yang lebih spesifik atau hubungi admin melalui WhatsApp.";
        }

        $distanceFormatted = number_format(
            $result['distance_km'],
            2,
            ',',
            '.'
        );

        $priceFormatted = 'Rp ' . number_format(
            $result['price'],
            0,
            ',',
            '.'
        );
        return "🚐 Estimasi Perjalanan RY Travel\n\n"
            . "📍 Asal: {$origin}\n"
            . "📍 Tujuan: {$destination}\n"
            . "📏 Jarak: {$distanceFormatted} km\n"
            . "💰 Estimasi Harga: {$priceFormatted}\n\n"
            . "Harga di atas merupakan estimasi berdasarkan jarak perjalanan. Untuk pemesanan atau informasi lebih lanjut, silakan hubungi admin RY Travel.";
    }
    protected function parseLocations(string $message): ?array
    {

        $message = trim($message);

        $patterns = [

            '/(?:berapa\s+)?(?:harga|biaya|ongkos|tarif|estimasi)?\s*dari\s+(.+?)\s+ke\s+(.+)/i',

            '/dari\s+(.+?)\s+ke\s+(.+)/i',

            '/(?:berapa\s+)?(?:harga|biaya|ongkos|tarif|estimasi)?\s+(.+?)\s+ke\s+(.+)/i',

            '/(.+?)\s+ke\s+(.+)/i',

        ];

        foreach ($patterns as $pattern) {

            if (preg_match($pattern, $message, $matches)) {

                $origin = trim($matches[1]);
                $origin = preg_replace(
                    '/^(harga|biaya|ongkos|tarif|estimasi|berapa|budget|ongkir|cost)\s+/i',
                    '',
                    $origin
                );
                $destination = trim($matches[2]);
                $origin = preg_replace('/^(dari)\s+/i', '', $origin);

                $destination = preg_replace(
                    '/\s+(dong|ya|kak|admin|tolong)$/i',
                    '',
                    $destination
                );

                $origin = trim($origin);
                $destination = trim($destination);

                $removeWords = [
                    'dong',
                    'ya',
                    'kak',
                    'admin',
                    'tolong',
                    'please',
                    'nih',
                    'min',
                ];

                $origin = str_ireplace($removeWords, '', $origin);
                $destination = str_ireplace($removeWords, '', $destination);

                $origin = trim($origin);
                $destination = trim($destination);

                if ($origin !== '' && $destination !== '') {

                    return [
                        $origin,
                        $destination
                    ];
                }
            }
        }
        $keywords = [
            'harga',
            'biaya',
            'ongkos',
            'tarif',
            'jarak',
            'estimasi',
            'berapa',
            'budget',
            'ongkir',
            'cost',
        ];

        foreach ($keywords as $keyword) {

            if (stripos($message, $keyword) !== false) {
                return null;
            }
        }

        return null;
    }
}
