<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ChatbotService
{
    private string $systemPrompt = <<<PROMPT
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

    public function ask(string $message): string
    {
        // 1. Coba Groq
        try {
            return $this->askGroq($message);
        } catch (\Throwable $e) {
        }

        // 2. Jika gagal coba Gemini
        try {
            return $this->askGemini($message);
        } catch (\Throwable $e) {
        }

        // 3. Jika gagal coba OpenRouter
        try {
            return $this->askOpenRouter($message);
        } catch (\Throwable $e) {
        }

        return "Maaf, chatbot sedang ramai. Silakan coba beberapa saat lagi atau hubungi admin RY Travel.";
    }
    private function askGroq(string $message): string
    {
        $apiKey = env('GROQ_API_KEY');

        if (empty($apiKey)) {
            throw new \Exception('Groq API Key belum dikonfigurasi.');
        }

        $response = Http::timeout(30)
            ->acceptJson()
            ->withToken($apiKey)
            ->post('https://api.groq.com/openai/v1/chat/completions', [

                'model' => env('GROQ_MODEL'),

                'messages' => [

                    [
                        'role' => 'system',
                        'content' => $this->systemPrompt,
                    ],

                    [
                        'role' => 'user',
                        'content' => $message,
                    ],

                ],

                'temperature' => 0.7,
                'max_tokens' => 1024,
            ]);

        if (!$response->successful()) {
            throw new \Exception(
                'Groq Error : ' . $response->body()
            );
        }

        return trim(
            $response->json()['choices'][0]['message']['content']
                ?? 'Maaf, saya belum dapat memberikan jawaban.'
        );
    }
    private function askGemini(string $message): string
    {
        $apiKey = env('GEMINI_API_KEY');

        if (empty($apiKey)) {
            throw new \Exception('Gemini API Key belum dikonfigurasi.');
        }

        $url = "https://generativelanguage.googleapis.com/v1beta/models/"
            . env('GEMINI_MODEL')
            . ":generateContent?key={$apiKey}";

        $prompt = $this->systemPrompt . "\n\nPertanyaan pelanggan:\n" . $message;

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
            throw new \Exception(
                'Gemini Error : ' . $response->body()
            );
        }

        $data = $response->json();

        return trim(
            $data['candidates'][0]['content']['parts'][0]['text']
                ?? 'Maaf, saya belum dapat memberikan jawaban.'
        );
    }
    private function askOpenRouter(string $message): string
    {
        $apiKey = env('OPENROUTER_API_KEY');

        if (empty($apiKey)) {
            throw new \Exception('OpenRouter API Key belum dikonfigurasi.');
        }

        $response = Http::timeout(30)
            ->acceptJson()
            ->withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
                'HTTP-Referer' => config('app.url'),
                'X-Title' => 'RY Travel'
            ])
            ->post('https://openrouter.ai/api/v1/chat/completions', [

                'model' => env('OPENROUTER_MODEL'),

                'messages' => [

                    [
                        'role' => 'system',
                        'content' => $this->systemPrompt,
                    ],

                    [
                        'role' => 'user',
                        'content' => $message,
                    ],

                ],

                'temperature' => 0.7,
                'max_tokens' => 1024,

            ]);

        if (!$response->successful()) {
            throw new \Exception(
                'OpenRouter Error : ' . $response->body()
            );
        }

        return trim(
            $response->json()['choices'][0]['message']['content']
                ?? 'Maaf, saya belum dapat memberikan jawaban.'
        );
    }
}
