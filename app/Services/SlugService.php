<?php

namespace App\Services;

use Illuminate\Support\Str;

class SlugService
{
    public function slug($value = []): String
    {
        $slug = implode("-", $value) . '-' . Str::random(6);
        return Str::slug($slug);
    }
}
