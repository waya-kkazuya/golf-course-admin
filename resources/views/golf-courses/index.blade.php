<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ゴルフコース一覧</title>
</head>
<body>
    <h1>ゴルフコース一覧</h1>

    <form method="post" action="{{ route('logout') }}" >
        @csrf 
    
        <button type="submit">ログアウト</button>
    </form>
</body>
</html>