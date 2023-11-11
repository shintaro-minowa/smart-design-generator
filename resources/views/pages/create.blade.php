<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>スマートデザインジェネレーター</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
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

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>スマートデザインジェネレーター</h1>
        <form id="designForm" action="{{ route('pages.store') }}" method="POST">
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

    <div class="overlay" id="overlay">
        <div>
            <i class="fas fa-spinner fa-spin" style="font-size:48px;color:white;"></i>
            <h2 style="color: white;">デザイン生成中</h2>
        </div>
    </div>

    <script>
        document.getElementById('designForm').addEventListener('submit', function(e) {
            document.getElementById('overlay').style.display = 'flex';
        });
    </script>
</body>

</html>
