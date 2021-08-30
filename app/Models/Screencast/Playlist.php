<?php

namespace App\Models\Screencast;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'price', 'description', 'thumbnail'];
    protected $withCount = ['videos'];

    public function getPictureAttribute()
    {
        return asset('storage/' . $this->thumbnail);
    }

    // relationship
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
