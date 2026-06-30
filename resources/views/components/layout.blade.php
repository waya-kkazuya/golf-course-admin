<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

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

    <!-- Leaflet JS（bodyの最後に配置） -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</body>

</html>
