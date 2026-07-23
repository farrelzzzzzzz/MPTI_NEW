<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ChatbotService
{
    public function askGemini(string $message): string
    {
        $apiKey = env('GEMINI_API_KEY');

        if (empty($apiKey)) {
            return 'API Key Gemini belum dikonfigurasi.';
        }

        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-3.5-flash-lite:generateContent?key={$apiKey}";

        $systemPrompt = <<<PROMPT
Kamu adalah RY Travel Assistant.

Tugasmu membantu pelanggan RY Travel.

Aturan:
- Jawab dalam Bahasa Indonesia.
- Ramah, sopan, dan profesional.
- Jawaban singkat dan jelas.
- Jangan mengaku sebagai ChatGPT.
- Perkenalkan diri sebagai RY Travel Assistant.
- Layanan website hanya untuk Antar Jemput Bandara.
- Untuk paket wisata atau harga khusus, arahkan pengguna menghubungi admin.
PROMPT;

        $prompt = $systemPrompt . "\n\nPertanyaan pelanggan:\n" . $message;
        try {

            $response = Http::timeout(30)
                ->acceptJson()
                ->post($url, [
                    'contents' => [
                        [
                            'parts' => [
                                [
                                    'text' => $prompt
                                ]
                            ]
                        ]
                    ]
                ]);

            if (!$response->successful()) {
                return 'Maaf, layanan chatbot sedang mengalami gangguan. Silakan coba beberapa saat lagi.';
            }

            $data = $response->json();
            $answer = $data['candidates'][0]['content']['parts'][0]['text']
                ?? 'Maaf, saya belum dapat memberikan jawaban.';

            return trim($answer);
        } catch (\Throwable $e) {

            return 'Terjadi kesalahan saat menghubungi layanan chatbot. Silakan coba lagi nanti.';
        }
    }
}
