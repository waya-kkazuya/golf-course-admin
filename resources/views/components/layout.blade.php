<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <header class="global-header">
        <span class="global-header-title">ゴルフ場DBメンテナンスシステム</span>
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="btn btn-ghost">ログアウト</button>
        </form>
    </header>

    <div class="container">
        {{ $slot }}
    </div>
</body>

</html>
