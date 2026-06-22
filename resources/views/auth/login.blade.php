<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>ログイン画面</h1>

    <form method="post" action="{{ route('login') }}">
        @csrf

        <div class="form-group">   
            <label for="email">メールアドレス:</label>
            <input type="email" id="email" name="email" required>
            @error('email')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">パスワード:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <button type="submit">ログイン</button>
        </div>
    </form>
</body>
</html>