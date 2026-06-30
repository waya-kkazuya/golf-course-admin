@props(['action', 'showExport' => false])

<form action="{{ $action }}" method="GET" class="search-form">
    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="施設名・住所で検索" class="search-input">
    @error('keyword')
        <p>{{ $message }}</p>
    @enderror

    <select name="locale" class="search-select">
        <option value="">言語</option>
        <option value="ja" {{ request('locale') == 'ja' ? 'selected' : '' }}>ja</option>
        <option value="en" {{ request('locale') == 'en' ? 'selected' : '' }}>en</option>
    </select>

    <select name="state_prefecture" class="search-select">
        <option value="">都道府県・州</option>
        <optgroup label="日本">
            @foreach (App\Enums\Ja\JapanesePrefecture::cases() as $prefecture)
                <option value="{{ $prefecture->value }}"
                    {{ request('state_prefecture') === $prefecture->value ? 'selected' : '' }}>
                    {{ $prefecture->label() }}
                </option>
            @endforeach
        </optgroup>
        <optgroup label="アメリカ">
            @foreach (App\Enums\Ja\UsState::cases() as $state)
                <option value="{{ $state->value }}"
                    {{ request('state_prefecture') === $state->value ? 'selected' : '' }}>
                    {{ $state->label() }}
                </option>
            @endforeach
        </optgroup>
    </select>

    <select name="kind" class="search-select">
        <option value="">種別</option>
        <option value="indoor" {{ request('kind') === 'indoor' ? 'selected' : '' }}>インドア</option>
        <option value="outdoor" {{ request('kind') === 'outdoor' ? 'selected' : '' }}>アウトドア</option>
        <option value="short" {{ request('kind') === 'short' ? 'selected' : '' }}>ショートコース</option>
        <option value="long" {{ request('kind') === 'long' ? 'selected' : '' }}>ロングコース</option>
    </select>

    <button type="submit" class="search-btn">検索</button>

    @if ($showExport)
        <a href="{{ route('golf-courses.export', request()->query()) }}" class="search-export-btn">CSVエクスポート</a>
    @endif
</form>
