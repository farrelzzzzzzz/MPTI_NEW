<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Services\LocationAliasService;

class DistanceService
{
    /**
     * Menghitung jarak dan harga.
     */
    public function calculate(string $origin, string $destination): array
    {
        $apiKey = env('GOOGLE_MAPS_API_KEY');

        $result = [
            'distance_km' => null,
            'price' => 0
        ];

        if (empty($origin) || empty($destination)) {
            return $result;
        }

        // Jika bukan koordinat, ubah nama lokasi menjadi koordinat
        if (!$this->isCoordinate($origin)) {

            $geo = $this->geocode($origin);

            if ($geo === null) {
                return [
                    'distance_km' => null,
                    'price' => 0
                ];
            }

            $origin = $geo;
        }

        if (!$this->isCoordinate($destination)) {

            $geo = $this->geocode($destination);

            if ($geo === null) {
                return [
                    'distance_km' => null,
                    'price' => 0
                ];
            }

            $destination = $geo;
        }

        // Prioritas Google Distance Matrix
        if (!empty($apiKey)) {

            $google = $this->calculateFromGoogle(
                $origin,
                $destination,
                $apiKey
            );

            if ($google['distance_km'] !== null) {
                return $google;
            }
        }

        // Fallback ke OSRM
        if (
            $this->isCoordinate($origin) &&
            $this->isCoordinate($destination)
        ) {
            return $this->calculateFromOSRM(
                $origin,
                $destination
            );
        }

        return $result;
    }

    protected function calculateFromGoogle($origin, $destination, $apiKey): array
    {
        try {

            $response = Http::timeout(15)->get(
                'https://maps.googleapis.com/maps/api/distancematrix/json',
                [
                    'origins' => $origin,
                    'destinations' => $destination,
                    'units' => 'metric',
                    'key' => $apiKey,
                ]
            );

            if (!$response->successful()) {
                return [
                    'distance_km' => null,
                    'price' => 0
                ];
            }

            $data = $response->json();

            if (
                !isset($data['rows'][0]['elements'][0]) ||
                $data['rows'][0]['elements'][0]['status'] !== 'OK'
            ) {
                return [
                    'distance_km' => null,
                    'price' => 0
                ];
            }

            $meters = $data['rows'][0]['elements'][0]['distance']['value'];

            $km = round($meters / 1000, 2);

            return [
                'distance_km' => $km,
                'price' => max(round($km * 7500), 1000)
            ];
        } catch (\Exception $e) {

            return [
                'distance_km' => null,
                'price' => 0
            ];
        }
    }

    protected function calculateFromOSRM($origin, $destination): array
    {
        try {

            [$olat, $olon] = explode(',', $origin);
            [$dlat, $dlon] = explode(',', $destination);

            $url = sprintf(
                'https://router.project-osrm.org/route/v1/driving/%s,%s;%s,%s?overview=false',
                $olon,
                $olat,
                $dlon,
                $dlat
            );

            $response = Http::timeout(15)->get($url);

            if (!$response->successful()) {
                return [
                    'distance_km' => null,
                    'price' => 0
                ];
            }

            $data = $response->json();

            if (
                !isset($data['routes'][0]['distance'])
            ) {
                return [
                    'distance_km' => null,
                    'price' => 0
                ];
            }

            $meters = $data['routes'][0]['distance'];

            $km = round($meters / 1000, 2);

            return [
                'distance_km' => $km,
                'price' => max(round($km * 7500), 1000)
            ];
        } catch (\Exception $e) {

            return [
                'distance_km' => null,
                'price' => 0
            ];
        }
    }
    protected function geocode(string $location): ?string
    {

        $locationService = app(LocationAliasService::class);

        $query = $locationService->normalize($location);

        if (!$locationService->isSupported($query)) {
            return null;
        }
    
        try {

            $response = Http::withHeaders([
                'User-Agent' => 'RYTravel/1.0'
            ])->timeout(10)->get(
                'https://nominatim.openstreetmap.org/search',
                [
                    'q' => $query,
                    'format' => 'json',
                    'limit' => 1,
                    'addressdetails' => 1,
                ]
            );

            if (!$response->successful()) {
                return null;
            }

            $data = $response->json();

            if (empty($data)) {
                return null;
            }

            $place = $data[0];

            if (!isset($place['lat'], $place['lon'])) {
                return null;
            }

            return $place['lat'] . ',' . $place['lon'];
        } catch (\Throwable $e) {
            return null;
        }
    }
    protected function isCoordinate(string $value): bool
    {
        return (bool) preg_match(
            '/^-?\d+(\.\d+)?,-?\d+(\.\d+)?$/',
            trim($value)
        );
    }
}
