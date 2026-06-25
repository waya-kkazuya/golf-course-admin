<x-layout>
    <x-slot:title>
        ゴルフ場DBメンテナンスシステム
    </x-slot>

    <h1>ゴルフコースを編集</h1>

    <form action="{{ route('golf-courses.update', $golfCourse) }}" method="POST">
        @csrf
        @method('PUT')
        @include('golf-courses._form')
        <button type="submit">更新</button>
    </form>

    <p><a href="{{ route('golf-courses.show', $golfCourse) }}">詳細へ</a></p>
</x-layout>
