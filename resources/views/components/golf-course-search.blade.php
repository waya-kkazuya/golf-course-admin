@props(['action'])

<form action="{{ $action }}" method="GET">
    {{-- 検索フォーム --}}
    <input type="text" name="keyword" value="{{ $keyword ?? '' }}" placeholder="施設名・住所で検索">
    @error('keyword')
        <p>{{ $message }}</p>
    @enderror

    <select name="locale">
        <option value="">locale</option>
        <option value="ja" {{ request('locale') == 'ja' ? 'selected' : '' }}>ja</option>
        <option value="en" {{ request('locale') == 'en' ? 'selected' : '' }}>en</option>
    </select>

    <select name="state_prefecture">
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

    <select name="kind">
        <option value="">種別</option>
        <option value="indoor" {{ request('kind') === 'indoor' ? 'selected' : '' }}>インドア</option>
        <option value="outdoor" {{ request('kind') === 'outdoor' ? 'selected' : '' }}>アウトドア</option>
        <option value="short" {{ request('kind') === 'short' ? 'selected' : '' }}>ショートコース</option>
        <option value="long" {{ request('kind') === 'long' ? 'selected' : '' }}>ロングコース</option>
    </select>

    <button type="submit">検索</button>
</form>
