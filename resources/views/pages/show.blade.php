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
            margin: 10px auto;
            padding-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .code-editor-wrapper {
            position: relative;
            width: 32%;
        }

        .code-editor {
            background-color: #1e1e1e;
            color: white;
            font-family: Consolas, 'Courier New', monospace;
            padding: 10px;
            border-radius: 4px;
            overflow: auto;
            width: 100%;
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prettier/2.0.3/standalone.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prettier/2.0.3/parser-html.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prettier/2.0.3/parser-postcss.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prettier/2.0.3/parser-babel.min.js"></script>
</head>

<body>
    <div id="code-editor-container">
        <div class="code-editor-wrapper">
            <span class="code-editor-label">HTML</span>
            <textarea id="html-editor" class="code-editor">
                {!! htmlspecialchars($page->content->body_html) !!}
            </textarea>
        </div>
        <div class="code-editor-wrapper">
            <span class="code-editor-label">CSS</span>
            <textarea id="css-editor" class="code-editor">
                {!! htmlspecialchars($page->content->style_css) !!}
            </textarea>
        </div>
        <div class="code-editor-wrapper">
            <span class="code-editor-label">JS</span>
            <textarea id="js-editor" class="code-editor">
                {!! htmlspecialchars($page->content->script_js) !!}
            </textarea>
        </div>
    </div>

    {!! $page->content->body_html !!}

    <script>
        {!! $page->content->script_js !!}

        function formatCode() {
            // HTML、CSS、JSのエディターからコードを取得
            var htmlCode = document.getElementById('html-editor').value;
            var cssCode = document.getElementById('css-editor').value;
            var jsCode = document.getElementById('js-editor').value;

            // Prettierを使用してフォーマット
            var formattedHtml = prettier.format(htmlCode, {
                parser: "html",
                plugins: prettierPlugins
            });
            var formattedCss = prettier.format(cssCode, {
                parser: "css",
                plugins: prettierPlugins
            });
            var formattedJs = prettier.format(jsCode, {
                parser: "babel",
                plugins: prettierPlugins
            });

            // フォーマットしたコードをエディターに戻す
            document.getElementById('html-editor').value = formattedHtml;
            document.getElementById('css-editor').value = formattedCss;
            document.getElementById('js-editor').value = formattedJs;
        }

        // ページの読み込みが完了したら、フォーマット関数を呼び出す
        window.onload = formatCode;
    </script>
</body>

</html>
