<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class GolfCourse extends Model
{
    use SoftDeletes;

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

    public function scopeKeyword($query, $keyword)
    {
        return $query->when($keyword, function($q) use ($keyword) {
                $q->where('course_name', 'like', "%{$keyword}%")
                ->orWhere('address', 'like', "%{$keyword}%");
        });
    }

    public function scopeLocale($query, $locale)
    {
        return $query->when($locale, fn($q) => $q->where('locale', $locale));
    }
}