<!DOCTYPE html>
<html>
<head>
    <title>ページ作成</title>
</head>
<body>
    <form action="{{ route('pages.store') }}" method="POST">
        @csrf
        <label for="idea">サイトのアイディア:</label>
        <input type="text" name="idea" id="idea" required>
        <button type="submit">生成</button>
    </form>
</body>
</html>
