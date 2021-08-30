<?php

use Illuminate\Support\Str;

function getSlug($value = []): String
{
    $slug = implode("-", $value) . '-' . Str::random(6);
    return Str::slug($slug);
}

function formatPrice($string): String
{
    return str_replace(',', '.', number_format($string));
}
