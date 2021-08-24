<?php

namespace App\Models\Screencast;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'price', 'description', 'thumbnail'];

    // relationship
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
