<x-layout>
    <x-slot:title>
        ゴルフ場DBメンテナンスシステム
    </x-slot>

    <h1>ゴルフコース詳細</h1>

    <a href="{{ route('golf-courses.edit', $golfCourse) }}">編集</a>
    <a href="{{ route('golf-courses.delete', $golfCourse) }}">削除</a>

    <dl>
        <dt>id</dt> <!-- Definition Term：用語・項目名 -->
        <dd>{{ $golfCourse->id }}</dd> <!-- Definition Description：説明・値 -->

        <dt>locale</dt>
        <dd>{{ $golfCourse->locale }}</dd>

        <dt>country_code</dt>
        <dd>{{ $golfCourse->country_code }}</dd>

        <dt>都道府県・州名</dt>
        <dd>{{ $golfCourse->state_prefecture }}</dd>

        <dt>施設名</dt>
        <dd>{{ $golfCourse->course_name }}</dd>

        <dt>分類コード</dt>
        <dd>{{ $golfCourse->kinds }}</dd>

        <dt>公式サイトURL</dt>
        <dd>{{ $golfCourse->web }}</dd>

        <dt>代表電話</dt>
        <dd>{{ $golfCourse->phone }}</dd>

        <dt>住所</dt>
        <dd>{{ $golfCourse->address }}</dd>

        <dt>種別</dt>
        <dd>{{ $golfCourse->kind }}</dd>

        <dt>緯度・経度（°）</dt>
        <dd>
            {{ $golfCourse->lat !== null ? number_format($golfCourse->lat, 6) : '-' }}
            /
            {{ $golfCourse->lng !== null ? number_format($golfCourse->lng, 6) : '-' }}
        </dd>

        <dt>問い合わせメール</dt>
        <dd>{{ $golfCourse->form_email }}</dd>

        <dt>予約先URL／番号</dt>
        <dd>{{ $golfCourse->reservation }}</dd>

        <dt>予約手段（電話／WEB／メール 等）</dt>
        <dd>{{ $golfCourse->reservation_method }}</dd>

        <dt>備考</dt>
        <dd>{!! nl2br(e($golfCourse->remarks)) !!}</dd>

        <dt>画像1</dt>
        <dd>
            @if ($golfCourse->image1_url)
                <img src="{{ $golfCourse->image1_url }}" alt="ゴルフ場画像">
            @endif
        </dd>

        <dt>画像2</dt>
        <dd>
            @if ($golfCourse->image2_url)
                <img src="{{ $golfCourse->image2_url }}" alt="ゴルフ場画像">
            @endif
        </dd>

        <dt>画像3</dt>
        <dd>
            @if ($golfCourse->image3_url)
                <img src="{{ $golfCourse->image3_url }}" alt="ゴルフ場画像">
            @endif
        </dd>

        <dt>作成日時</dt>
        <dd>{{ $golfCourse->created_at_formatted }}</dd>

        <dt>更新日時</dt>
        <dd>{{ $golfCourse->updated_at_formatted }}</dd>
    </dl>

    <p><a href="{{ route('golf-courses.index') }}">一覧へ戻る</a></p>
</x-layout>
