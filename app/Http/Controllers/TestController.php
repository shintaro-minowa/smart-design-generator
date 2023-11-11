<?php

namespace App\Http\Controllers;

use App\Services\ChatGPTService;
use DOMDocument;

class TestController extends Controller
{
    protected $chatGPTService;

    public function __construct(ChatGPTService $chatGPTService)
    {
        $this->chatGPTService = $chatGPTService;
    }

    public function index()
    {
        $messages = [
            ['role' => 'user', 'content' => 'おしゃれなwebサイトのソースコードを書いてください。HTMLドキュメントを作成してください。ドキュメントには、スタイリングのための<style>タグ内のCSSコードと、動作のための<script>タグ内のJavaScriptコードを含めてください。']
        ];

        $response = $this->chatGPTService->getGptResponse($messages);

        \Log::info('gpt response', $response);

        // レスポンスからHTML、CSS、JSを抽出
        $extractedContent = $this->extractCodeFromResponse($response['choices'][0]['message']['content']);

        \Log::info('extractedContent', $extractedContent);
    }
    private function extractCodeFromResponse($response)
    {
        $html = $this->extractHtml($response);
        $css = $this->extractCss($response);
        $js = $this->extractJs($response);

        return [
            'html' => $html,
            'css' => $css,
            'js' => $js
        ];
    }

    function extractHtml($content)
    {
        // CSSとJavaScriptのセクションを除去
        $content = preg_replace('/<style>.*?<\/style>/s', '', $content);
        $content = preg_replace('/<script>.*?<\/script>/s', '', $content);

        // HTMLセクションを抽出
        preg_match('/<!DOCTYPE html>(.*?)<\/html>/s', $content, $matches);
        return $matches[1];
    }

    function extractCss($content)
    {
        // CSSセクションを抽出
        preg_match('/<style>(.*?)<\/style>/s', $content, $matches);
        return $matches[1];
    }

    function extractJs($content)
    {
        // JavaScriptセクションを抽出
        preg_match('/<script>(.*?)<\/script>/s', $content, $matches);
        return $matches[1];
    }
}
