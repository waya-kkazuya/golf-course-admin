<x-layout>
    <x-slot:title>
        ゴルフ場DBメンテナンスシステム
    </x-slot>

    <h1>ゴルフコースを新規作成</h1>

    <form action="{{ route('golf-courses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('golf-courses._form')

        <dt><label for="image1">画像1</label></dt>
        <dd>
            <input type="file" id="image1" name="image1" accept="image/*">
            @error('image1')
                <span class="error">{{ $message }}</span>
            @enderror
        </dd>

        <dt><label for="image2">画像2</label></dt>
        <dd>
            <input type="file" id="image2" name="image2" accept="image/*">
            @error('image2')
                <span class="error">{{ $message }}</span>
            @enderror
        </dd>

        <dt><label for="image3">画像3</label></dt>
        <dd>
            <input type="file" id="image3" name="image3" accept="image/*">
            @error('image3')
                <span class="error">{{ $message }}</span>
            @enderror
        </dd>

        <button type="submit">登録</button>
    </form>
</x-layout>
