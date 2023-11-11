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
        $title = $request->input('title');
        $siteType = $request->input('site-type');
        $color = $request->input('color');
        $designDetails = $request->input('design-details');

        $idea = [
            'title' => $title,
            'siteType' => $siteType,
            'color' => $color,
            'designDetails' => $designDetails
        ];

        // GPTのAPIを呼び出し、HTML/CSS/JSを生成
        $generatedContent = $this->generateContentFromIdea($idea);

        // ログに内容を記録
        \Log::info('Generated Content:', $generatedContent);

        // ユーザーがログインしていればそのIDを、していなければnullを設定
        $userId = auth()->check() ? auth()->id() : null;

        $page = Page::create(['title' => $title, 'user_id' => $userId]);
        $content = new Content([
            'full_html' => $generatedContent['full_html'],
            'body_html' => $generatedContent['body_html'],
            'style_css' => $generatedContent['style_css'],
            'script_js' => $generatedContent['script_js'],
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

        // $idea 配列から値を取得
        $title = htmlspecialchars($idea['title']);
        $siteType = htmlspecialchars($idea['siteType']);
        $color = htmlspecialchars($idea['color']);
        $designDetails = htmlspecialchars($idea['designDetails']);

        $content = 'HTMLドキュメントを作成してください。' . "\n" .
            '### 条件 ###' . "\n" .
            'ドキュメントには、スタイリングのための<style>タグ内のCSSコードと、動作のための<script>タグ内のJavaScriptコードを含めてください。' . "\n" .
            '### サイトのタイトル ###' . "\n" .
            $title . "\n" .
            '### サイトのタイプ ###' . "\n" .
            $siteType . "\n" .
            '### カラーテーマ ###' . "\n" .
            $color . "\n" .
            '### 詳細 ###' . "\n" .
            $designDetails;
            // 'ユーザーが作成したいサイトの種類、色、を選択できるようにする。デザインアイディアの詳細をテキストで入力できるようにする。「デザイン生成」ボタン表示する';

        $messages = [
            ['role' => 'user', 'content' => $content]
        ];

        \Log::info('GPT API request', $messages);

        $response = $this->chatGPTService->getChatResponse($messages);

        \Log::info('GPT API response', $response);

        // レスポンスからHTML、CSS、JSを抽出
        $extractedContent = $this->extractCodeFromResponse($response['choices'][0]['message']['content']);

        \Log::info('extractedContent', $extractedContent);

        return [
            'full_html' => $extractedContent['full_html'],
            'body_html' => $extractedContent['body_html'],
            'style_css' => $extractedContent['style_css'],
            'script_js' => $extractedContent['script_js']
        ];
    }

    private function extractCodeFromResponse($response)
    {
        $full_html = $this->extractFullHtml($response);
        $body_html = $this->extractBodyHtml($response);
        $style_css = $this->extractStyleCss($response);
        $script_js = $this->extractScriptJs($response);

        return [
            'full_html' => $full_html,
            'body_html' => $body_html,
            'style_css' => $style_css,
            'script_js' => $script_js,
        ];
    }

    function extractFullHtml($content)
    {
        // HTMLセクションを抽出
        preg_match('/(<!DOCTYPE html>.*?<\/html>)/s', $content, $matches);
        return $matches[1];
    }

    function extractBodyHtml($content)
    {
        // JavaScriptのセクションを除去
        $content = preg_replace('/<script>.*?<\/script>/s', '', $content);

        // CSSセクションを抽出
        preg_match('/<body>(.*?)<\/body>/s', $content, $matches);
        return $matches[1];
    }
    function extractStyleCss($content)
    {
        // CSSセクションを抽出
        preg_match('/<style>(.*?)<\/style>/s', $content, $matches);
        return $matches[1];
    }

    function extractScriptJs($content)
    {
        // JavaScriptセクションを抽出
        preg_match('/<script>(.*?)<\/script>/s', $content, $matches);
        return $matches[1];
    }
}
