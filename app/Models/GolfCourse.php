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
}