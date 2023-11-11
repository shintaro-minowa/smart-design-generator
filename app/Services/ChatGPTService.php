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
    sleep(3);

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
      <title>My Web Application</title>
      <style>
        body {
          background-color: #f4f4f4;
          color: #333;
          font-family: Arial, sans-serif;
        }
        .container {
          max-width: 1200px;
          margin: 0 auto;
          padding: 20px;
        }
        h1 {
          color: #007bff;
        }
        button {
          background-color: #007bff;
          color: #fff;
          padding: 10px 15px;
          border: none;
          cursor: pointer;
        }
        button:hover {
          background-color: #0056b3;
        }
      </style>
    </head>
    <body>
      <div class=\"container\">
        <h1>My Web Application</h1>
        <p>Welcome to my web application. Click the button to see it in action.</p>
        <button onclick=\"showMessage()\">Click me!</button>
        <p id=\"message\" style=\"display:none;\">You clicked the button!</p>
      </div>
      <script>
        function showMessage() {
          document.getElementById(\"message\").style.display = \"block\";
        }
      </script>
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
