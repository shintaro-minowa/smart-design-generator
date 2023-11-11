<!DOCTYPE html>
<html>

<head>
    <title>{{ $page->title }}</title>
    <style>
        {!! $page->content->style_css !!}

        /* code-containerに適用されるスタイル */
        #code-editor {
            background-color: #1e1e1e;
            /* VSCodeの背景色 */
            color: white;
            /* 文字色 */
            font-family: Consolas, 'Courier New', monospace;
            /* フォント */
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            overflow: auto;
            width: 90%;
            /* 幅を調整 */
            height: 100px;
            /* 高さを調整 */
            border: none;
            /* ボーダーを除去 */
            resize: none;
            /* サイズ変更を不可に */
        }

        .copy-button {
            background-color: #007acc;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <textarea id="code-editor">
        {!! htmlspecialchars($page->content->body_html) !!}
    </textarea>

    {!! $page->content->body_html !!}

    <script>
        {!! $page->content->script_js !!}
    </script>
</body>

</html>
