<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Builder;

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
