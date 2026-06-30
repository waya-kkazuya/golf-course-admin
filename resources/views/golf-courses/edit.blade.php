<x-layout>
    <x-slot:title>
        ゴルフ場DBメンテナンスシステム
    </x-slot>

    <div class="page-header">
        <h1 class="page-title">ゴルフコース編集</h1>
        <div class="page-header-actions">
            <a href="{{ route('golf-courses.show', $golfCourse) }}" class="btn btn-muted">詳細へ戻る</a>
            <a href="{{ route('golf-courses.index') }}" class="btn btn-muted">一覧へ戻る</a>
        </div>
    </div>

    <div class="detail-card">
        <form action="{{ route('golf-courses.update', $golfCourse) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <dl>
                @include('golf-courses._form')

                {{-- 画像1 --}}
                <dt><label for="image1">画像1</label></dt>
                <dd>
                    @if ($golfCourse->image1_url)
                        <div class="image-preview">
                            <img src="{{ $golfCourse->image1_url }}" alt="現在の画像" style="max-width: 200px;">
                            <label class="delete-check">
                                <input type="checkbox" id="delete_image1" name="delete_image1" value="1"
                                    onchange="toggleFileInput('image1', this.checked)">
                                <span class="delete-label">この画像を削除する</span>
                            </label>
                        </div>
                    @endif
                    <input type="file" id="image1" name="image1" accept="image/*"
                        onchange="toggleDeleteCheck('image1', this.files.length > 0)">
                    @error('image1')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </dd>

                {{-- 画像2 --}}
                <dt><label for="image2">画像2</label></dt>
                <dd>
                    @if ($golfCourse->image2_url)
                        <div class="image-preview">
                            <img src="{{ $golfCourse->image2_url }}" alt="現在の画像" style="max-width: 200px;">
                            <label class="delete-check">
                                <input type="checkbox" id="delete_image2" name="delete_image2" value="1"
                                    onchange="toggleFileInput('image2', this.checked)">
                                <span class="delete-label">この画像を削除する</span>
                            </label>
                        </div>
                    @endif
                    <input type="file" id="image2" name="image2" accept="image/*"
                        onchange="toggleDeleteCheck('image2', this.files.length > 0)">
                    @error('image2')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </dd>

                {{-- 画像3 --}}
                <dt><label for="image3">画像3</label></dt>
                <dd>
                    @if ($golfCourse->image3_url)
                        <div class="image-preview">
                            <img src="{{ $golfCourse->image3_url }}" alt="現在の画像" style="max-width: 200px;">
                            <label class="delete-check">
                                <input type="checkbox" id="delete_image3" name="delete_image3" value="1"
                                    onchange="toggleFileInput('image3', this.checked)">
                                <span class="delete-label">この画像を削除する</span>
                            </label>
                        </div>
                    @endif
                    <input type="file" id="image3" name="image3" accept="image/*"
                        onchange="toggleDeleteCheck('image3', this.files.length > 0)">
                    @error('image3')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </dd>
            </dl>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">更新</button>
            </div>
        </form>
    </div>

</x-layout>
