<?php

namespace App\Services;

class LocationAliasService
{
    protected array $aliases = [

        // Bandara YIA
        'yia' => 'Yogyakarta International Airport',
        'bandara yia' => 'Yogyakarta International Airport',
        'bandara jogja' => 'Yogyakarta International Airport',
        'bandara yogyakarta' => 'Yogyakarta International Airport',
        'yogyakarta international airport' => 'Yogyakarta International Airport',

        // Adisutjipto
        'adisutjipto' => 'Adisutjipto International Airport',
        'bandara adisutjipto' => 'Adisutjipto International Airport',

        // Kota
        'jogja' => 'Yogyakarta',
        'yogyakarta' => 'Yogyakarta',
        'solo' => 'Surakarta',
        'surakarta' => 'Surakarta',

        // Kabupaten
        'bantul' => 'Bantul, Yogyakarta',
        'sleman' => 'Sleman, Yogyakarta',
        'kulon progo' => 'Kulon Progo, Yogyakarta',
        'gunungkidul' => 'Gunungkidul, Yogyakarta',

        // Wisata
        'malioboro' => 'Malioboro, Yogyakarta',
        'prambanan' => 'Candi Prambanan',
        'parangtritis' => 'Pantai Parangtritis',

        // Kampus
        'ugm' => 'Universitas Gadjah Mada',
        'uin suka' => 'UIN Sunan Kalijaga',
    ];

    /**
     * Lokasi yang didukung oleh RY Travel
     */
    protected array $supportedKeywords = [
        'yogyakarta',
        'jogja',
        'bantul',
        'sleman',
        'kulon progo',
        'gunungkidul',
        'wonosari',
        'surakarta',
        'solo',
        'malioboro',
        'prambanan',
        'parangtritis',
        'airport',
        'bandara',
        'ugm',
        'uin',
    ];

    public function normalize(string $location): string
    {
        $location = trim($location);

        if ($location === '') {
            return $location;
        }

        $key = strtolower($location);

        return $this->aliases[$key] ?? $location;
    }

    /**
     * Mengecek apakah lokasi masih berada di area layanan RY Travel
     */
    public function isSupported(string $location): bool
    {
        $location = strtolower($location);

        foreach ($this->supportedKeywords as $keyword) {
            if (str_contains($location, $keyword)) {
                return true;
            }
        }

        return false;
    }
}
