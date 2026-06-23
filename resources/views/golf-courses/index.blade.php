<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ゴルフコース一覧</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>ゴルフコース一覧</h1>

    <form method="post" action="{{ route('logout') }}" >
        @csrf 
    
        <button type="submit">ログアウト</button>
    </form>

    <form action="{{ route('golf-courses.index') }}" method="GET">
        {{-- 検索フォーム --}}
        <input type="text" name="keyword" value="{{ $keyword ?? '' }}" placeholder="施設名・住所で検索">
        @error('keyword')
            <p>{{ $message }}</p>
        @enderror
        
        <select name="locale">
            <option value="">すべて</option>
            <option value="ja" {{ request('locale') == 'ja' ? 'selected' : '' }}>ja</option>
            <option value="en" {{ request('locale') == 'en' ? 'selected' : '' }}>en</option>
        </select>

        <button type="submit">検索</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>施設名</th>
                <th>都道府県・州名</th>
                <th>住所</th>
                <th>locale</th>
                <th class="kinds-col">種別</th>
                <th>phone</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $golf_courses as $golf_course )
                <tr>
                    <td>{{ $golf_course->id }}</td>
                    <td>{{ $golf_course->course_name }}</td>
                    <td>{{ $golf_course->state_prefecture }}</td>
                    <td>{{ $golf_course->address }}</td>
                    <td>{{ $golf_course->locale }}</td>
                    {{-- 切り出し部分 --}}
                    <td>
                        {{ $golf_course->kind }}
                    </td>
                    <td>{{ $golf_course->phone }}</td>
                    <td>
                        <a href="#" class="btn btn-view">詳細</a>
                        <a href="#" class="btn btn-edit">編集</a>
                        <a href="#" class="btn btn-delete">削除</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>