<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Content;

class PageController extends Controller
{
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

        $page = Page::create(['title' => $idea, 'user_id' => auth()->id()]);
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
        // モックの実装
        return [
            'html' => '<p>Generated HTML for: ' . htmlspecialchars($idea) . '</p>',
            'css' => 'p { color: blue; }',
            'js' => 'console.log("Generated JS for: ' . htmlspecialchars($idea) . '");'
        ];
    }
}
