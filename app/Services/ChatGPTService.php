<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ChatGPTService
{
    protected $endpoint = 'https://api.openai.com/v1/chat/completions';
    protected $apiKey; // APIキーを設定

    public function __construct()
    {
        $this->apiKey = env('OPENAI_API_KEY');
    }

    public function getGptResponse($messages)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->endpoint, [
                    'model' => 'gpt-4-vision-preview',
                    'max_tokens' => 4096,
                    'messages' => $messages,
                ]);

        return $response->json();
    }
}
