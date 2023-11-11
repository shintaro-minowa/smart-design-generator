<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Webデザインジェネレーター</title>
    <style>
        body {
            background-color: #add8e6;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 60%;
            margin: 0 auto;
            padding: 20px;
            background-color: #f0f8ff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #ddd;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            background-color: #1e90ff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #00bfff;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Webデザインジェネレーター</h1>
        <form action="{{ route('pages.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">サイトのタイトル</label>
                <input type="text" id="title" name="title">
            </div>
            <div class="form-group">
                <label for="site-type">サイトの種類</label>
                <select id="site-type">
                    <option value="homepage">ホームページ</option>
                    <option value="Web Application">Webアプリ</option>
                    <option value="game">ゲーム</option>
                </select>
            </div>
            <div class="form-group">
                <label for="color">カラーテーマ</label>
                <select id="color">
                    <option value="light">ライト</option>
                    <option value="dark">ダーク</option>
                    <option value="colorful">カラフル</option>
                    <option value="blue">青</option>
                </select>
            </div>
            <div class="form-group">
                <label for="design-details">デザイン詳細</label>
                <textarea id="design-details" rows="5" placeholder="作成したいサイトのデザインの詳細を入力してください。"></textarea>
            </div>
            <button type="submit">Webデザインを生成する</button>
    </div>
    </form>
</body>

</html>
