<x-layout>
    <x-slot:title>
        ゴルフ場DBメンテナンスシステム
    </x-slot>

    <h1>ゴルフコースを新規作成</h1>

    <form action="{{ route('golf-courses.store') }}" method="POST">
        @csrf
        @include('golf-courses._form')
        <button type="submit">登録</button>
    </form>
</x-layout>
