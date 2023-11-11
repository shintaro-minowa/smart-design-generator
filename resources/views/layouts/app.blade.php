<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Title test')</title>
    <!-- BootstrapのCSS読み込み -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

    <div class="container">
        <!-- ヘッダー -->
        <header class="py-3 mb-4 border-bottom">
            <div class="d-flex justify-content-between">
                <h2>@yield('header', 'Title test')</h2>
                <div>
                    @auth
                        <!-- ログアウトリンク -->
                        <a href="{{ route('logout') }}" class="btn btn-danger"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            ログアウト
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <!-- ログインリンク -->
                        <a href="{{ route('login') }}" class="btn btn-success">ログイン</a>
                        <!-- 会員登録リンク -->
                        <a href="{{ route('register') }}" class="btn btn-primary">会員登録</a>
                    @endauth
                </div>
            </div>
        </header>

        <!-- コンテンツ -->
        <div class="row">
            @yield('content')
        </div>
    </div>

    <!-- BootstrapのJS読み込み -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
