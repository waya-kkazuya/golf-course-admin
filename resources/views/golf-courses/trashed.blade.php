<x-layout>
    <x-slot:title>
        ゴルフ場DBメンテナンスシステム
    </x-slot>

    <h1>削除済みゴルフコース一覧
        <a href="{{ route('golf-courses.index') }}">一覧へ戻る</a>
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

    <x-golf-course-search :action="route('golf-courses.trashed')" />

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
                        <form action="{{ route('golf-courses.restore', $golfCourse) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-edit">復元</button>
                        </form>
                        <form action="{{ route('golf-courses.force-delete', $golfCourse) }}" method="POST"
                            style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete"
                                onclick="return confirm('完全に削除します。この操作は取り消せません。よろしいですか？')">
                                完全削除
                            </button>
                        </form>
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
