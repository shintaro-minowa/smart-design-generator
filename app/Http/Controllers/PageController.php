<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Content;
use App\Services\ChatGPTService;
use DOMDocument;

class PageController extends Controller
{
    protected $chatGPTService;

    public function __construct(ChatGPTService $chatGPTService)
    {
        $this->chatGPTService = $chatGPTService;
    }

    public function create()
    {
        return view('pages.create');
    }

    public function store(Request $request)
    {
        $idea = $request->input('idea');

        // 外部APIを呼び出し、HTML/CSS/JSを生成（モック）
        $generatedContent = $this->generateContentFromIdea($idea);

        // ログに内容を記録
        \Log::info('Generated Content:', $generatedContent);

        // ユーザーがログインしていればそのIDを、していなければnullを設定
        $userId = auth()->check() ? auth()->id() : null;

        $page = Page::create(['title' => $idea, 'user_id' => $userId]);
        $content = new Content([
            'html_content' => $generatedContent['html'],
            'css_content' => $generatedContent['css'],
            'js_content' => $generatedContent['js'],
        ]);
        $page->content()->save($content);

        return redirect()->route('pages.show', $page);
    }

    public function show(Page $page)
    {
        return view('pages.show', ['page' => $page]);
    }

    private function generateContentFromIdea($idea)
    {
        // モック
        // return [
        //     'html' => '<p>Generated HTML for: ' . htmlspecialchars($idea) . '</p>',
        //     'css' => 'p { color: blue; }',
        //     'js' => 'console.log("Generated JS for: ' . htmlspecialchars($idea) . '");'
        // ];

        $content = 'HTMLドキュメントを作成してください。' . "\n" .
                   '### 条件 ###' . "\n" .
                   'ドキュメントには、スタイリングのための<style>タグ内のCSSコードと、動作のための<script>タグ内のJavaScriptコードを含めてください。' . "\n" .
                   '### 種類 ###' . "\n" .
                   'ホームページ' . "\n" .
                   '### デザインの案 ###' . "\n" .
                   '青をベースに' . "\n" .
                   '詳細' . "\n" .
                   '株式会社テストのホームページを作成したいです。';

        $messages = [
            ['role' => 'user', 'content' => $content]
        ];

        $response = $this->chatGPTService->getChatResponse($messages);

        \Log::info('gpt response', $response);

        // レスポンスからHTML、CSS、JSを抽出
        $extractedContent = $this->extractCodeFromResponse($response['choices'][0]['message']['content']);

        \Log::info('extractedContent', $extractedContent);

        return [
            'html' => $extractedContent['html'],
            'css' => $extractedContent['css'],
            'js' => $extractedContent['js']
        ];
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
