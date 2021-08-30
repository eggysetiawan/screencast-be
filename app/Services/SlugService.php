<?php

namespace App\Services;

use Illuminate\Support\Str;

class SlugService
{
    public static function slug($value = [], $isUnique = true): String
    {
        $unique = $isUnique ?  '-' . Str::random(6) : null;
        $slug = implode("-", $value) . $unique;
        return Str::slug($slug);
    }
}
