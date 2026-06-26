<x-layout>
    <x-slot:title>
        ゴルフ場DBメンテナンスシステム
    </x-slot>

    <h1>削除確認</h1>

    <dl>
        <dt>施設名</dt>
        <dd>{{ $golfCourse->course_name }}</dd>

        <dt>エリア</dt>
        <dd>{{ $golfCourse->state_prefecture }}</dd>

        <dt>locale</dt>
        <dd>{{ $golfCourse->locale }}</dd>
    </dl>
    <p>本当に削除しますか？<br>※削除後は削除済み一覧から復元できます。</p>

    <div class="confirm-actions">
        <a href="{{ route('golf-courses.index') }}" class="btn btn-view">キャンセル</a>
        <form action="{{ route('golf-courses.destroy', $golfCourse) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-delete">はい、削除します</button>
        </form>
    </div>
</x-layout>
