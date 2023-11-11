<!DOCTYPE html>
<html>
<head>
    <title>{{ $page->title }}</title>
    <style>
        {!! $page->content->style_css !!}

        /* code-containerに適用されるスタイル */
        #code-container {
            background-color: #1e1e1e; /* VSCodeの背景色 */
            color: white; /* 文字色 */
            font-family: Consolas, 'Courier New', monospace; /* フォント */
            white-space: pre; /* ソースコードのフォーマットを維持 */
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            overflow: auto;
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

    <!-- ソースコード表示エリア -->
    <div id="code-container">
        {!! htmlspecialchars($page->content->body_html) !!}
    </div>
    <!-- コピー用ボタン -->
    <button class="copy-button" onclick="copyCode()">コピー</button>

    {!! $page->content->body_html !!}
    <script>
        {!! $page->content->script_js !!}

        // 追加されたJavaScript
        function copyCode() {
            var code = document.getElementById('code-container').innerText;
            navigator.clipboard.writeText(code).then(function() {
                alert('コードをコピーしました！');
            }, function(err) {
                alert('コピーに失敗しました: ', err);
            });
        }
    </script>
</body>
</html>
