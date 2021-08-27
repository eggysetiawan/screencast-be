<?php

namespace App\Http\Controllers\Screencast;

use Illuminate\Http\Request;
use App\Models\Screencast\{Video, Playlist};
use App\Http\Controllers\Controller;
use App\Http\Requests\Screencast\VideoRequest;
use App\Services\SlugService;

class VideoController extends Controller
{
    public function create(Playlist $playlist)
    {
        $video = new Video();
        return view('videos.create', compact('playlist', 'video'));
    }

    public function store(VideoRequest $request, Playlist $playlist)
    {
        $attr = $request->validated();
        $attr['slug'] = SlugService::slug([$request->title]);
        $attr['is_intro'] = $request->intro ? true : false;

        $playlist->videos()->create($attr);
        return back();
    }
}
