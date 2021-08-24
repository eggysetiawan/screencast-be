<?php

namespace App\Http\Controllers\Screencast;

use App\Services\SlugService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Screencast\PlaylistRequest;

class PlaylistController extends Controller
{
    public function create()
    {
        return view('playlists.create');
    }

    public function store(PlaylistRequest $request)
    {
        $attr = $request->validated();
        $attr['slug'] = (new SlugService)->slug($request->name);
        $attr['thumbnail'] = $request->file('thumbnail')->store('images/playlist');

        auth()->user()->playlists()->create($attr);
        return back();
    }

    public function table()
    {
        return view('playlists.table');
    }
}
