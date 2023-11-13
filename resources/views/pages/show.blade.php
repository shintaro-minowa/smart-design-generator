<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="スマートデザインジェネレーター">
    <meta property="og:description" content="Webデザインを一瞬で生成">
    <meta property="og:url" content="https://smart-design-generator-cfa7c4008e3e.herokuapp.com/">
    <meta property="og:image" content="https://i.imgur.com/2TWoVMQ.png" />
    <title>{{ $page->title }}</title>
    <style>
        body {
            margin: 0;
        }

        #code-editor-container {
            position: relative;
            width: 100%;
            padding-top: 10px;
            padding-bottom: 10px;
            display: flex;
            justify-content: space-between;
            background-color: black;
        }

        .code-editor-wrapper {
            position: relative;
            width: 32%;
        }

        .code-editor {
            background-color: #1e1e1e;
            color: white;
            font-family: Consolas, 'Courier New', monospace;
            overflow: auto;
            width: 100%;
            height: 100px;
            border: none;
            resize: none;
        }

        .code-editor-label {
            position: absolute;
            top: -5px;
            left: 0;
            background-color: #1e1e1e;
            color: white;
            padding: 3px 5px;
            font-size: 0.8em;
        }

        /* 追加：コードブロックのスタイリング */
        pre.code-editor {
            white-space: pre-wrap;
            word-break: keep-all;
        }

        /* 追加：行番号のスタイリング */
        pre code {
            display: block;
            padding-left: 10px;
        }

        #full-html-container {}
    </style>

    <!-- highlight.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/xml.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/css.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/javascript.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/vs2015.min.css">

    <!-- Prettier -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prettier/2.0.3/standalone.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prettier/2.0.3/parser-html.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prettier/2.0.3/parser-postcss.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prettier/2.0.3/parser-babel.min.js"></script>
</head>

<body>
    <div id="code-editor-container">
        <div class="code-editor-wrapper">
            <span class="code-editor-label">HTML</span>
            <pre class="code-editor" contenteditable="true"><code id="html-editor" class="language-xml">
                {!! htmlspecialchars($page->content->body_html) !!}
            </code></pre>
        </div>
        <div class="code-editor-wrapper">
            <span class="code-editor-label">CSS</span>
            <pre class="code-editor" contenteditable="true"><code id="css-editor" class="language-css">
                {!! htmlspecialchars($page->content->style_css) !!}
            </code></pre>
        </div>
        <div class="code-editor-wrapper">
            <span class="code-editor-label">JS</span>
            <pre class="code-editor" contenteditable="true"><code id="js-editor" class="language-javascript">
                {!! htmlspecialchars($page->content->script_js) !!}
            </code></pre>
        </div>
    </div>

    <button onclick="location.href='/'" style="position: absolute; margin: 5px 5px; z-index: 1000;">戻る</button>

    <div id="full-html-container">
        {!! $page->content->full_html !!}
    </div>

    <script>
        // Prettierでフォーマットする関数
        function formatCode() {
            // HTML、CSS、JSのコードエディタを取得
            const htmlCode = document.getElementById('html-editor').textContent;
            const cssCode = document.getElementById('css-editor').textContent;
            const jsCode = document.getElementById('js-editor').textContent;

            // Prettierを使ってフォーマット
            const formattedHtml = prettier.format(htmlCode, {
                parser: "html",
                plugins: prettierPlugins
            });
            const formattedCss = prettier.format(cssCode, {
                parser: "css",
                plugins: prettierPlugins
            });
            const formattedJs = prettier.format(jsCode, {
                parser: "babel",
                plugins: prettierPlugins
            });

            // フォーマットされたコードをエディタに戻す
            document.getElementById('html-editor').textContent = formattedHtml;
            document.getElementById('css-editor').textContent = formattedCss;
            document.getElementById('js-editor').textContent = formattedJs;
        }

        // コードをフォーマットし、highlight.jsでハイライトする関数
        function formatAndHighlightCode() {
            // コードをフォーマット
            formatCode();

            // highlight.jsを使用してコードをハイライト
            document.querySelectorAll('pre code').forEach((block) => {
                hljs.highlightElement(block);
            });
        }

        // ページロード時にフォーマットとハイライトを実行
        window.onload = formatAndHighlightCode;
    </script>

</body>

</html>
