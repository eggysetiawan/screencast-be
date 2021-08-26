<?php

namespace App\Models\Screencast;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public static function selectTag()
    {
        return static::pluck('name', 'id');
    }

    public static function validTag()
    {
        return static::pluck('id')->toArray();
    }

    // relationship
    public function playlists()
    {
        return $this->belongsToMany(Playlist::class);
    }
}
