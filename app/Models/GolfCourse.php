<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class GolfCourse extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'locale',
        'country_code',
        'state_prefecture',
        'course_name',
        'kinds',
        'web',
        'phone',
        'address',
        'indoor',
        'outdoor',
        'short_course',
        'long_course',
        'lat',
        'lng',
        'form_email',
        'reservation',
        'reservation_method',
        'remarks',
        'image1',
        'image2',
        'image3',
    ];

    protected function kind(): Attribute
    {
        return Attribute::make(
            get: fn() => collect([
                $this->indoor ? 'インドア' : null,
                $this->outdoor ? 'アウトドア' : null,
                $this->short_course ? 'ショートコース' : null,
                $this->long_course ? 'ロングコース' : null,
            ])->filter()->implode(' / ')
        );
    }

    protected function image1Url(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->image1 ? Storage::url($this->image1) : null
        );
    }

    protected function image2Url(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->image2 ? Storage::url($this->image2) : null
        );
    }

    protected function image3Url(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->image3 ? Storage::url($this->image3) : null
        );
    }

    protected function createdAtFormatted(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->created_at?->format('Y年m月d日 H:i')
        );
    }

    protected function updatedAtFormatted(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->updated_at?->format('Y年m月d日 H:i')
        );
    }

    public function scopeKeyword(Builder $query, ?string $keyword): Builder
    {
        return $query->when($keyword, function ($q) use ($keyword) {
            $escaped = addcslashes($keyword, '%_\\');

            $q->where('course_name', 'like', "%{$escaped}%")
                ->orWhere('address', 'like', "%{$escaped}%");
        });
    }

    public function scopeLocale(Builder $query, ?string $locale): Builder
    {
        return $query->when($locale, fn($q) => $q->where('locale', $locale));
    }

    public function scopeStatePrefecture(Builder $query, ?string $statePrefecture)
    {
        return $query->when($statePrefecture, fn($q) => $q->where('state_prefecture', $statePrefecture));
    }

    public function scopeKind(Builder $query, ?string $kind)
    {
        $columnMap = [
            'indoor'  => 'indoor',
            'outdoor' => 'outdoor',
            'short'   => 'short_course',
            'long'    => 'long_course',
        ];

        return $query->when(
            $kind && array_key_exists($kind, $columnMap),
            fn($q) => $q->where($columnMap[$kind], true)
        );
    }
}
