<!DOCTYPE html>
<html>

<head>
    <title>{{ $page->title }}</title>
    <style>
        /* 既存のスタイル */
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
            margin-right: 25px;
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
            top: -20px;
            left: 0;
            background-color: grey;
            color: white;
            padding: 3px 5px;
            border-radius: 4px;
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
    </style>

    <!-- highlight.jsのコアライブラリと必要な言語、テーマ -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/xml.min.js"></script> <!-- HTML用 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/css.min.js"></script> <!-- CSS用 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/javascript.min.js"></script> <!-- JS用 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/vs.min.css">
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

    {!! $page->content->body_html !!}

    <script>
        // highlight.jsの初期化
        document.addEventListener('DOMContentLoaded', (event) => {
            document.querySelectorAll('pre code').forEach((block) => {
                hljs.highlightBlock(block);
            });
        });
    </script>
</body>

</html>
