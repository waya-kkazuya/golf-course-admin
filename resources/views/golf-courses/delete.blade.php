<x-layout>
    <x-slot:title>
        ゴルフ場DBメンテナンスシステム
    </x-slot>

    <div class="page-header">
        <h1 class="page-title">削除確認</h1>
        <div class="page-header-actions">
            <a href="{{ route('golf-courses.index') }}" class="btn btn-muted">一覧へ戻る</a>
        </div>
    </div>

    <div class="detail-card">
        <dl>
            <dt>施設名</dt>
            <dd>{{ $golfCourse->course_name }}</dd>

            <dt>エリア</dt>
            <dd>{{ $golfCourse->state_prefecture }}</dd>

            <dt>言語</dt>
            <dd>
                <span class="badge {{ $golfCourse->locale === 'ja' ? 'badge-ja' : 'badge-en' }}">
                    {{ $golfCourse->locale }}
                </span>
            </dd>
        </dl>

        <div class="confirm-message">
            <p>⚠️ 本当に削除しますか？<br>※削除後は削除済み一覧から復元できます。</p>
        </div>

        <div class="confirm-actions">
            <a href="{{ route('golf-courses.index') }}" class="btn btn-primary">キャンセル</a>
            <form action="{{ route('golf-courses.destroy', $golfCourse) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete-muted">はい、削除します</button>
            </form>
        </div>
    </div>

</x-layout>
