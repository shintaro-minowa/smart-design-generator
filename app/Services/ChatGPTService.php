<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\GptLog;

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

    // データベースにリクエストとレスポンスを保存
    GptLog::create([
      'request' => json_encode($messages, JSON_UNESCAPED_UNICODE),
      'response' => $response->body(),
    ]);

    return $response->json();
  }

  function getMockGptResponse($messages)
  {
    sleep(1);

    // モックのレスポンスデータ
    $mockResponse = [
      "id" => "chatcmpl-8JeZxInB0EPqdEbQIc5wUdL1tFJCM",
      "object" => "chat.completion",
      "created" => 1699694909,
      "model" => "gpt-4-1106-vision-preview",
      "usage" => [
        "prompt_tokens" => 61,
        "completion_tokens" => 268,
        "total_tokens" => 329
      ],
      "choices" => [
        [
          "message" => [
            "role" => "assistant",
            "content" => "<!DOCTYPE html>
            <html>
            <head>
                <title>My Website</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: lightblue;
                        color: blue;
                    }

                    header {
                        background-color: blue;
                        color: white;
                        padding: 10px;
                        text-align: center;
                    }

                    footer {
                        background-color: blue;
                        color: white;
                        padding: 10px;
                        text-align: center;
                        position: absolute;
                        bottom: 0;
                        width: 100%;
                    }

                    .container {
                        max-width: 1200px;
                        margin: auto;
                    }

                    .content {
                        padding: 20px;
                    }

                </style>
                <script>
                    function changeBackground() {
                        document.body.style.backgroundColor = \"lightgrey\";
                    }
                </script>
            </head>
            <body onload=\"changeBackground()\">
                <header>
                    <h1>Welcome to My Website</h1>
                </header>

                <div class=\"container\">
                    <div class=\"content\">
                        <p>This is my homepage. Welcome and enjoy your stay!</p>
                        <button onclick=\"changeBackground()\">Change background color</button>
                    </div>
                </div>

                <footer>
                    <p>&copy; 2023 My Website</p>
                </footer>
            </body>
            </html>"
          ],
          "finish_details" => [
            "type" => "stop",
            "stop" => ""
          ],
          "index" => 0
        ]
      ]
    ];

    // レスポンスを返す
    return $mockResponse;
  }
}
