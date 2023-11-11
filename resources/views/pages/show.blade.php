<!DOCTYPE html>
<html>

<head>
    <title>{{ $page->title }}</title>
    <style>
        {!! $page->content->style_css !!}

        /* code-containerに適用されるスタイル */
        #code-editor-container {
            position: relative;
            /* 追加：ラベルを正確に配置するための相対位置 */
            width: 90%;
            margin: 10px 0;
        }

        #code-editor {
            background-color: #1e1e1e;
            color: white;
            font-family: Consolas, 'Courier New', monospace;
            padding: 10px;
            border-radius: 4px;
            overflow: auto;
            width: 90%;
            height: 100px;
            border: none;
            resize: none;
        }

        .code-editor-label {
            position: absolute;
            /* 追加：絶対位置でラベルを配置 */
            top: 0px;
            /* 追加：ラベルの位置調整 */
            left: 0px;
            /* 追加：ラベルの位置調整 */
            background-color: #007acc;
            color: white;
            padding: 2px 5px;
            border-radius: 4px;
            font-size: 0.8em;
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
    <div id="code-editor-container">
        <span class="code-editor-label">HTML</span> <!-- 追加：ラベル要素 -->
        <textarea id="code-editor">
            {!! htmlspecialchars($page->content->body_html) !!}
        </textarea>
    </div>

    {!! $page->content->body_html !!}

    <script>
        {!! $page->content->script_js !!}
    </script>
</body>

</html>
