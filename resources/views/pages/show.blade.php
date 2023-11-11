<!DOCTYPE html>
<html>

<head>
    <title>{{ $page->title }}</title>
    <style>
        {!! $page->content->style_css !!}

        /* code-containerに適用されるスタイル */
        #code-editor-container {
            position: relative;
            width: 100%;
            /* 変更：幅を拡大 */
            margin: 10px auto;
            /* 中央揃え */
            padding-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .code-editor-wrapper {
            position: relative;
            /* 追加：ラッパーに対する相対位置指定 */
            width: 32%;
            /* その他のスタイル */
        }

        #code-editor {
            background-color: #1e1e1e;
            color: white;
            font-family: Consolas, 'Courier New', monospace;
            padding: 10px;
            border-radius: 4px;
            overflow: auto;
            width: 100%;
            /* エディタの幅をラッパーに合わせる */
            height: 100px;
            border: none;
            resize: none;
        }

        .code-editor-label {
            position: absolute;
            top: 0;
            left: 0;
            background-color: grey;
            color: white;
            padding: 3px 5px;
            border-radius: 4px;
            font-size: 0.8em;
        }
    </style>
</head>

<body>
    <div id="code-editor-container">
        <div class="code-editor-wrapper">
            <span class="code-editor-label">HTML</span>
            <textarea id="code-editor">
                {!! htmlspecialchars($page->content->body_html) !!}
            </textarea>
        </div>
        <div class="code-editor-wrapper">
            <span class="code-editor-label">CSS</span>
            <textarea id="code-editor">
                {!! htmlspecialchars($page->content->style_css) !!}
            </textarea>
        </div>
        <div class="code-editor-wrapper">
            <span class="code-editor-label">JavaScript</span>
            <textarea id="code-editor">
                {!! htmlspecialchars($page->content->script_js) !!}
            </textarea>
        </div>
    </div>

    {!! $page->content->body_html !!}

    <script>
        {!! $page->content->script_js !!}
    </script>
</body>

</html>
