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
        $attr['slug'] = SlugService::slug([$request->name]);
        // $attr['slug'] = getSlug([$request->name]); // this function is from app/helper.php
        $attr['thumbnail'] = $request->file('thumbnail')->store('images/playlist');

        DB::transaction(function () use ($attr) {
            $playlists = auth()->user()->playlists()->create($attr);
            $playlists->tags()->sync($attr['tags']);
        });
        return back();
    }

    public function table()
    {
        $playlists = Playlist::query()
            ->when(!auth()->user()->hasRole('admin'), function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->paginate(10);

        return view('playlists.table', compact('playlists'));
    }

    public function edit(Playlist $playlist)
    {
        $this->authorize('update', $playlist);
        $tags = Tag::selectTag();
        return view('playlists.edit', compact('playlist', 'tags'));
    }

    public function update(PlaylistRequest $request, Playlist $playlist)
    {
        $this->authorize('update', $playlist);
        $attr = $request->validated();
        $attr['thumbnail'] = $this->getThumbnail($request, $playlist);

        DB::transaction(function () use ($playlist, $attr) {
            $playlist->update($attr);
            $playlist->tags()->sync($attr['tags']);
        });


        return redirect(route('playlists.table'));
    }

    public function destroy(Playlist $playlist)
    {
        $this->authorize('delete', $playlist);
        DB::transaction(function () use ($playlist) {
            Storage::delete($playlist->thumbnail);
            $playlist->tags()->detach();
            $playlist->delete();
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
