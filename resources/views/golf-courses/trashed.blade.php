<x-layout>
    <x-slot:title>
        ゴルフ場DBメンテナンスシステム
    </x-slot>

    <div class="page-header">
        <h1 class="page-title">削除済みゴルフコース一覧</h1>
        <div class="page-header-actions">
            <a href="{{ route('golf-courses.index') }}" class="btn btn-muted">一覧へ戻る</a>
        </div>
    </div>

    @if (session('success'))
        <div class="flash flash-success">
            {{ session('success') }}
        </div>
    @endif

    <x-golf-course-search :action="route('golf-courses.trashed')" />

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>施設名</th>
                    <th>都道府県・州名</th>
                    <th>言語</th>
                    <th class="kinds-col">種別</th>
                    <th>電話番号</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($golfCourses as $golfCourse)
                    <tr>
                        <td>{{ $golfCourse->id }}</td>
                        <td>{{ $golfCourse->course_name }}</td>
                        <td>{{ $golfCourse->state_prefecture }}</td>
                        <td>
                            <span class="badge {{ $golfCourse->locale === 'ja' ? 'badge-ja' : 'badge-en' }}">
                                {{ $golfCourse->locale }}
                            </span>
                        </td>
                        <td>{{ $golfCourse->kind }}</td>
                        <td>{{ $golfCourse->phone }}</td>
                        <td>
                            <div class="actions">
                                <form action="{{ route('golf-courses.restore', $golfCourse) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="action-btn edit">復元</button>
                                </form>
                                <form action="{{ route('golf-courses.force-delete', $golfCourse) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn del"
                                        onclick="return confirm('完全に削除します。この操作は取り消せません。よろしいですか？')">
                                        完全削除
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="table-empty">該当するゴルフ場が見つかりませんでした。</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="table-footer">
        {{ $golfCourses->appends(request()->query())->links() }}
    </div>

</x-layout>
