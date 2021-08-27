<?php

namespace App\Http\Controllers\Screencast;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Screencast\Tag;
use App\Http\Controllers\Controller;
use App\Http\Requests\Screencast\TagRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function table()
    {
        $tags = Tag::query()
            ->withCount('playlists')
            ->latest()
            ->paginate(10);

        return view('tags.table', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tag = new Tag();
        return view('tags.create', compact('tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        $attr = $request->validated();
        $attr['slug'] = Str::slug($request->name);
        Tag::create($attr);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Screencast\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Screencast\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Screencast\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, Tag $tag)
    {
        $attr   = $request->validated();
        $attr['slug'] = Str::slug($request->name);
        $tag->update($attr);
        return redirect(route('tags.table'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Screencast\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->playlists()->detach();
        $tag->delete();
        return back();
    }
}
