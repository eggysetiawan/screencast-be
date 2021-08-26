<?php

namespace App\Http\Controllers\Screencast;

use App\Services\SlugService;
use App\Models\Screencast\Playlist;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Screencast\PlaylistRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PlaylistController extends Controller
{
    public function create()
    {
        return view('playlists.create', [
            'playlist' => new Playlist(),
        ]);
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
        $playlists = Playlist::query()
            ->where('user_id', auth()->id())
            ->paginate(10);

        return view('playlists.table', compact('playlists'));
    }

    public function edit(Playlist $playlist)
    {
        return view('playlists.edit', compact('playlist'));
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
