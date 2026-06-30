<x-layout>
    <x-slot:title>
        ゴルフ場DBメンテナンスシステム
    </x-slot>

    <div class="page-header">
        <h1 class="page-title">ゴルフコース一覧</h1>
        <div class="page-header-actions">
            <a href="{{ route('golf-courses.trashed') }}" class="btn btn-muted">削除済み一覧</a>
            <a href="{{ route('golf-courses.create') }}" class="btn btn-primary">新規作成</a>
        </div>
    </div>

    @if (session('success'))
        <div class="flash flash-success">
            {{ session('success') }}
        </div>
    @endif

    <x-golf-course-search :action="route('golf-courses.index')" :show-export="true" />

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>施設名</th>
                    <th>都道府県・州名</th>
                    <th>言語</th>
                    <th class="kinds-col">種別</th>
                    <th>代表電話</th>
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
                                <a href="{{ route('golf-courses.show', $golfCourse) }}" class="action-btn view">詳細</a>
                                <a href="{{ route('golf-courses.edit', $golfCourse) }}" class="action-btn edit">編集</a>
                                <a href="{{ route('golf-courses.delete', $golfCourse) }}" class="action-btn del">削除</a>
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
