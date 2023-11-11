<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Design Generator</title>
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
        <h1>Smart Design Generator</h1>
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
