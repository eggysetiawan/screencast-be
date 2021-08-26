<?php

namespace App\Http\Controllers\Screencast;

use App\Services\SlugService;
use App\Models\Screencast\Tag;
use Illuminate\Support\Facades\DB;
use App\Models\Screencast\Playlist;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Screencast\PlaylistRequest;

class PlaylistController extends Controller
{
    public function create()
    {
        $playlist = new Playlist();
        $tags = Tag::selectTag();
        return view('playlists.create', compact('playlist', 'tags'));
    }

    public function store(PlaylistRequest $request)
    {
        $attr = $request->validated();
        // dd($attr['tags']);
        $attr['slug'] = (new SlugService)->slug([$request->name]);
        $attr['thumbnail'] = $request->file('thumbnail')->store('images/playlist');

        DB::transaction(function () use ($attr) {
            $playlists = auth()->user()->playlists()->create($attr);
            $playlists->tags()->attach($attr['tags']);
        });
        return back();
    }

    public function table()
    {
        $playlists = Playlist::query()
            ->where('user_id', auth()->id())
            ->paginate(10);

        return view('playlists.table', compact('playlists'));
    }

    public function edit(Playlist $playlist)
    {
        $tags = Tag::selectTag();
        return view('playlists.edit', compact('playlist', 'tags'));
    }

    public function update(PlaylistRequest $request, Playlist $playlist)
    {
        $attr = $request->validated();
        $attr['thumbnail'] = $this->getThumbnail($request, $playlist);
        $playlist->update($attr);

        return redirect(route('playlists.table'));
    }

    public function destroy(Playlist $playlist)
    {
        DB::transaction(function () use ($playlist) {
            $playlist->tags()->detach();
            $playlist->delete();
            Storage::delete($playlist->thumbnail);
        });
        return back();
    }

    public function getThumbnail($request, $playlist)
    {
        $thumbnail = $playlist->thumbnail;

        if ($request->thumbnail) {
            Storage::delete($playlist->thumbnail);
            $thumbnail = $request->file('thumbnail')->store('images/playlist');
        }

        return $thumbnail;
    }
}
