<dl>
    <dt><label for="locale">locale</label></dt>
    <dd>
        <label>
            <input type="radio" name="locale" value="ja"
                {{ old('locale', $golfCourse->locale ?? 'ja') === 'ja' ? 'checked' : '' }} required> ja

        </label>
        <label>
            <input type="radio" name="locale" value="en"
                {{ old('locale', $golfCourse->locale ?? 'ja') === 'en' ? 'checked' : '' }}> en
        </label>
        @error('locale')
            <span class="error">{{ $message }}</span>
        @enderror
    </dd>

    <dt>country_code</dt>
    <dd>
        <label>
            <input type="radio" name="country_code" value="JP"
                {{ old('country_code', $golfCourse->country_code ?? 'JP') === 'JP' ? 'checked' : '' }} required> JP

        </label>
        <label>
            <input type="radio" name="country_code" value="US"
                {{ old('country_code', $golfCourse->country_code ?? 'JP') === 'US' ? 'checked' : '' }}>US
        </label>
        @error('country_code')
            <span class="error">{{ $message }}</span>
        @enderror
    </dd>

    <dt><label for="state_prefecture">都道府県・州名</label></dt>
    <dd>
        <select id="state_prefecture" name="state_prefecture">
            <option value="">選択してください</option>
            <optgroup label="日本">
                @foreach (App\Enums\Ja\JapanesePrefecture::cases() as $prefecture)
                    <option value="{{ $prefecture->value }}"
                        {{ old('state_prefecture', $golfCourse->state_prefecture ?? '') === $prefecture->value ? 'selected' : '' }}>
                        {{ $prefecture->label() }}
                    </option>
                @endforeach
            </optgroup>
            <optgroup label="アメリカ">
                @foreach (App\Enums\Ja\UsState::cases() as $state)
                    <option value="{{ $state->value }}"
                        {{ old('state_prefecture', $golfCourse->state_prefecture ?? '') === $state->value ? 'selected' : '' }}>
                        {{ $state->label() }}
                    </option>
                @endforeach
            </optgroup>
        </select>
        @error('state_prefecture')
            <span>{{ $message }}</span>
        @enderror
    </dd>


    <dt><label for="course_name">施設名</label></dt>
    <dd>
        <input type="text" id="course_name" name="course_name"
            value="{{ old('course_name', $golfCourse->course_name ?? '') }}" maxlength="255" required>
        @error('course_name')
            <span class="error">{{ $message }}</span>
        @enderror
    </dd>

    <dt><label for="kinds">分類コード</label></dt>
    <dd>
        <input type="number" id="kinds" name="kinds" value="{{ old('kinds', $golfCourse->kinds ?? '') }}"
            step="1">
        @error('kinds')
            <span class="error">{{ $message }}</span>
        @enderror
    </dd>

    <dt><label for="web">公式サイトURL</label></dt>
    <dd>
        <input type="url" id="web" name="web" value="{{ old('web', $golfCourse->url ?? '') }}""
            placeholder="https://example.com" maxlength="2048">
        @error('web')
            <span class="error">{{ $message }}</span>
        @enderror
    </dd>

    <dt><label for="phone">代表電話</label></dt>
    <dd>
        <input type="tel" id="phone" name="phone" value="{{ old('phone', $golfCourse->phone ?? '') }}""
            placeholder="000-0000-0000" maxlength="30">
        @error('phone')
            <span class="error">{{ $message }}</span>
        @enderror
    </dd>

    <dt><label for="address">住所</label></dt>
    <dd>
        <input type="text" id="address" name="address" value="{{ old('address', $golfCourse->address ?? '') }}""
            maxlength="30">
        @error('address')
            <span class="error">{{ $message }}</span>
        @enderror
    </dd>

    <dt>種別</dt>
    <dd>
        <label>
            <input type="hidden" name="indoor" value="0">
            <input type="checkbox" name="indoor" value="1"
                {{ old('indoor', $golfCourse->indoor ?? false) ? 'checked' : '' }}>
            インドア
        </label>
        <label>
            <input type="hidden" name="outdoor" value="0">
            <input type="checkbox" name="outdoor" value="1"
                {{ old('outdoor', $golfCourse->outdoor ?? false) ? 'checked' : '' }}>
            アウトドア
        </label>
        <label>
            <input type="hidden" name="short_course" value="0">
            <input type="checkbox" name="short_course" value="1"
                {{ old('short_course', $golfCourse->short_course ?? false) ? 'checked' : '' }}>
            ショートコース
        </label>
        <label>
            <input type="hidden" name="long_course" value="0">
            <input type="checkbox" name="long_course" value="1"
                {{ old('long_course', $golfCourse->long_course ?? false) ? 'checked' : '' }}>
            ロングコース
        </label>
        @error('indoor')
            <span class="error">{{ $message }}</span>
        @enderror
        @error('outdoor')
            <span class="error">{{ $message }}</span>
        @enderror
        @error('short_course')
            <span class="error">{{ $message }}</span>
        @enderror
        @error('long_course')
            <span class="error">{{ $message }}</span>
        @enderror
    </dd>

    <dt>緯度 / 経度</dt>
    <dd>
        <div style="display: flex; gap: 12px;">
            <div>
                <input type="number" id="lat" name="lat"
                    value="{{ old('lat', isset($golfCourse) && $golfCourse->lat !== null ? number_format($golfCourse->lat, 6) : '') }}"
                    step="0.000001" min="-90" max="90" placeholder="緯度 例）35.681236">
            </div>
            <div>
                <input type="number" id="lng" name="lng"
                    value="{{ old('lng', isset($golfCourse) && $golfCourse->lng !== null ? number_format($golfCourse->lng, 6) : '') }}"
                    step="0.000001" min="-180" max="180" placeholder="経度 例）139.767125">
            </div>
        </div>
        @error('lat')
            <span class="error">{{ $message }}</span>
        @enderror
        @error('lng')
            <span class="error">{{ $message }}</span>
        @enderror
    </dd>

    <dt><label for="form_email">問い合わせメール</label></dt>
    <dd>
        <input type="email" id="form_email" name="form_email"
            value="{{ old('form_email', $golfCourse->form_email ?? '') }}" placeholder="example@example.com"
            maxlength="255">
        @error('form_email')
            <span class="error">{{ $message }}</span>
        @enderror
    </dd>

    <dt><label for="reservation">予約先URL／番号</label></dt>
    <dd>
        <input type="text" id="reservation" name="reservation"
            value="{{ old('reservation', $golfCourse->reservation ?? '') }}"
            placeholder="https://example.com または 000-0000-0000" maxlength="255">
        @error('reservation')
            <span class="error">{{ $message }}</span>
        @enderror
    </dd>

    <dt><label for="reservation_method">予約手段（電話／WEB／メール 等）</label></dt>
    <dd>
        <input type="text" id="reservation_method" name="reservation_method"
            value="{{ old('reservation_method', $golfCourse->reservation_method ?? '') }}" maxlength="255">
        @error('reservation_method')
            <span class="error">{{ $message }}</span>
        @enderror
    </dd>

    <dt><label for="remarks">備考</label></dt>
    <dd>
        <textarea id="remarks" name="remarks" rows="4" maxlength="5000">{{ old('remarks', $golfCourse->remarks ?? '') }}</textarea>
        @error('remarks')
            <span class="error">{{ $message }}</span>
        @enderror
    </dd>

    {{-- 画像アップロードは後から実装 --}}
</dl>
