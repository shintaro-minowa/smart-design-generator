<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Content;
use App\Services\ChatGPTService;
use Illuminate\Support\Facades\App;

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
        $title = $request->input('title', '');
        $siteType = $request->input('site-type', '');
        $color = $request->input('color', '');
        $designDetails = $request->input('design-details', '');

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

        $userIp = $request->ip();

        $page = Page::create([
            'title' => $title,
            'user_id' => $userId,
            'user_ip' => $userIp
        ]);

        $content = new Content([
            'full_html' => $generatedContent['full_html'],
            'body_html' => $generatedContent['body_html'],
            'style_css' => $generatedContent['style_css'],
            'script_js' => $generatedContent['script_js'],
        ]);
        $page->content()->save($content);

        return redirect()->route('pages.show', ['code' => $page->code]);
    }

    public function show($code)
    {
        $page = Page::where('code', $code)->firstOrFail();
        return view('pages.show', ['page' => $page]);
    }

    private function generateContentFromIdea($idea)
    {
        $title = htmlspecialchars($idea['title']);
        $siteType = htmlspecialchars($idea['siteType']);
        $color = htmlspecialchars($idea['color']);
        $designDetails = htmlspecialchars($idea['designDetails']);

        $content = 'Please create an HTML document.' . "\n" .
            '### Requirements ###' . "\n" .
            'Include CSS code within the <style> tag for styling, and JavaScript code within the <script> tag for functionality.' . "\n" .
            '### Site Title ###' . "\n" .
            $title . "\n" .
            '### Type of Site ###' . "\n" .
            $siteType . "\n" .
            '### Color Theme ###' . "\n" .
            $color . "\n" .
            '### Details ###' . "\n" .
            $designDetails;

        $messages = [
            ['role' => 'user', 'content' => $content]
        ];

        \Log::info('GPT API request', $messages);

        if (App::environment('local') && env('USE_MOCK') === true) {
            $response = $this->chatGPTService->getMockGptResponse($messages);
        } else {
            $response = $this->chatGPTService->getGptResponse($messages);
        }

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
