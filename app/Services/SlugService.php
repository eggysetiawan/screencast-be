<?php

namespace App\Services;

use Illuminate\Support\Str;

class SlugService
{

    public function slug($value, $value2 = null)
    {
        $slug = $value . '-' . Str::random(6);
        if (!empty($value2)) {
            $slug = $value . '-' . $value2 . '-' . Str::random(6);
        }
        return Str::slug($slug);
    }
}
