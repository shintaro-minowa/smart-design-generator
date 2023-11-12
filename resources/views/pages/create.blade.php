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
                    <option value="landing-page">ランディングページ（LP）</option>
                    <option value="webapp">Webアプリケーション</option>
                    <option value="blog">ブログ</option>
                    <option value="portfolio">ポートフォリオ</option>
                    <option value="ecommerce">eコマース</option>
                    <option value="game">ゲーム</option>
                </select>
            </div>

            <div class="form-group">
                <label for="color">基本色</label>
                <select id="color" name="color">
                    <option value="lightblue">ライトブルー</option>
                    <option value="lavender">ラベンダー</option>
                    <option value="pink">ピンク</option>
                    <option value="cream">クリーム</option>
                    <option value="beige">ベージュ</option>
                    <option value="mint">ミント</option>
                    <option value="lightgreen">ライトグリーン</option>
                    <option value="charcoal">チャコール</option>
                </select>
            </div>

            <div class="form-group">
                <label for="color-theme">カラーテーマ</label>
                <select id="color-theme" name="color-theme">
                    <option value="light">明るい</option>
                    <option value="dark">暗い</option>
                    <option value="monochrome">モノクローム</option>
                    <option value="pastel">パステル</option>
                    <option value="vibrant">ビビッド</option>
                    <option value="earth-tone">アーストーン</option>
                </select>
            </div>

            <div class="form-group">
                <label for="font-style">フォントスタイル</label>
                <select id="font-style" name="font-style">
                    <option value="standard">標準（Arial, Verdanaなど）</option>
                    <option value="modern">モダン（Futura, Helveticaなど）</option>
                    <option value="traditional">伝統的（Times New Roman, Garamondなど）</option>
                    <option value="casual">カジュアル（Comic Sans, Arialなど）</option>
                    <option value="handwriting">手書き風（Brush Script, Lucida Handwritingなど）</option>
                    <option value="unique">ユニーク（Papyrus, Impactなど）</option>
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
