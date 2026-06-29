<x-layout>
    <x-slot:title>
        ゴルフ場DBメンテナンスシステム
    </x-slot>

    <h1>ゴルフコース一覧
        <a href="{{ route('golf-courses.create') }}">新規作成</a>
        <a href="{{ route('golf-courses.trashed') }}">削除済み一覧</a>
    </h1>

    <form method="post" action="{{ route('logout') }}">
        @csrf

        <button type="submit">ログアウト</button>
    </form>

    @if (session('success'))
        <div class="flash flash-success">
            {{ session('success') }}
        </div>
    @endif

    <x-golf-course-search :action="route('golf-courses.index')" />

    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>施設名</th>
                <th>都道府県・州名</th>
                <th>locale</th>
                <th class="kinds-col">種別</th>
                <th>phone</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($golfCourses as $golfCourse)
                <tr>
                    <td>{{ $golfCourse->id }}</td>
                    <td>{{ $golfCourse->course_name }}</td>
                    <td>{{ $golfCourse->state_prefecture }}</td>
                    <td>{{ $golfCourse->locale }}</td>
                    <td>
                        {{ $golfCourse->kind }}
                    </td>
                    <td>{{ $golfCourse->phone }}</td>
                    <td>
                        <a href="{{ route('golf-courses.show', $golfCourse) }}" class="btn btn-view">詳細</a>
                        <a href="{{ route('golf-courses.edit', $golfCourse) }}" class="btn btn-edit">編集</a>
                        <a href="{{ route('golf-courses.delete', $golfCourse) }}" class="btn btn-delete">削除</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">該当するゴルフ場が見つかりませんでした。</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $golfCourses->total() }}件
    {{ $golfCourses->appends(request()->query())->links() }}
</x-layout>
