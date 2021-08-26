<?php

namespace App\Models\Screencast;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class);
    }
}
