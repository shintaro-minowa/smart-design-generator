<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>スマートデザインジェネレーター</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa;
            color: #333;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        input,
        select,
        textarea,
        button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        button {
            background-color: #1e90ff;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #00bfff;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>スマートデザインジェネレーター</h1>
        <form action="{{ route('pages.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" id="title" name="title" value="My Website">
            </div>
            <div class="form-group">
                <label for="site-type">サイトタイプ</label>
                <select id="site-type" name="site-type">
                    <option value="Web Application">Webアプリケーション</option>
                    <option value="business">ビジネス</option>
                    <option value="blog">ブログ</option>
                    <option value="portfolio">ポートフォリオ</option>
                    <option value="e-commerce">Eコマース</option>
                    <option value="homepage">ホームページ</option>
                    <option value="game">ゲーム</option>
                </select>
            </div>
            <div class="form-group">
                <label for="color">色</label>
                <input type="text" id="color" name="color" value="青">
            </div>
            <div class="form-group">
                <label for="design-details">デザイン詳細</label>
                <textarea id="design-details" name="design-details" rows="5" placeholder="ここに具体的なデザイン要件を入力してください。"></textarea>
            </div>
            <button type="submit">デザイン生成</button>
        </form>
    </div>
</body>

</html>
