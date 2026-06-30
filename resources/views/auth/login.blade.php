<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="login-body">
    <div class="login-wrap">
        <h1 class="login-title">ゴルフ場DBメンテナンスシステム</h1>

        <div class="login-card">
            <h2 class="login-subtitle">ログイン</h2>

            <form method="post" action="{{ route('login') }}">
                @csrf

                @if ($errors->any())
                    <div class="flash flash-error">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="login-field">
                    <label for="email">メールアドレス</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="login-field">
                    <label for="password">パスワード</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary login-submit">ログイン</button>
            </form>
        </div>
    </div>
</body>

</html>
