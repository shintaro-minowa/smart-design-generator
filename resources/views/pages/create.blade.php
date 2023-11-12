<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="スマートデザインジェネレーター">
    <meta property="og:description" content="Webデザインを一瞬で生成">
    <meta property="og:url" content="https://smart-design-generator-cfa7c4008e3e.herokuapp.com/">
    <meta property="og:image" content="https://imgur.com/PGgm9Pa" />
    <title>スマートデザインジェネレーター</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
    @if ($errors->has('limit'))
        <div class="alert alert-danger">
            {{ $errors->first('limit') }}
        </div>
    @endif
    <div class="container">
        <h4>スマートデザインジェネレーター</h4>
        <form id="designForm" action="{{ route('pages.store') }}" method="POST">
            @csrf
            <div class="form-group mt-3">
                <label for="title">タイトル</label>
                <input type="text" id="title" name="title" value="My Website">
            </div>
            <div class="form-group">
                <label for="site-type">サイトタイプ</label>
                <select id="site-type" name="site-type">
                    <option value="homepage">ホームページ</option>
                    <option value="Web Application">Webアプリケーション</option>
                    <option value="game">ゲーム</option>
                </select>
            </div>
            <div class="form-group">
                <label for="color">ベースカラー</label>
                <select id="color" name="color">
                    <option value="blue">青</option>
                    <option value="red">赤</option>
                    <option value="green">緑</option>
                    <option value="yellow">黄</option>
                    <option value="purple">紫</option>
                    <option value="orange">橙</option>
                    <option value="black">黒</option>
                    <option value="white">白</option>
                    <option value="gray">灰</option>
                </select>
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
            <i class="fas fa-spinner fa-spin mb-3" style="font-size:48px;color:white;"></i>
            <h4 style="color: white;">デザイン生成中</h4>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var overlay = document.getElementById('overlay');
            var form = document.getElementById('designForm');

            // ページがキャッシュから読み込まれた場合、オーバーレイを非表示にする
            window.onpageshow = function(event) {
                if (event.persisted || (window.performance && window.performance.navigation.type == 2)) {
                    if (overlay) {
                        overlay.style.display = 'none';
                    }
                }
            };

            // フォーム送信イベント
            if (form) {
                form.addEventListener('submit', function(e) {
                    if (overlay) {
                        overlay.style.display = 'flex';
                    }
                });
            }
        });
    </script>
</body>

</html>
