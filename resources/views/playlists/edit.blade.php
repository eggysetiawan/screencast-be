<x-app-layout>
    <x-slot name="title">
        Edit Playlist
    </x-slot>

    <x-slot name="header">
        Edit Playlist : {{ $playlist->name }}
    </x-slot>

    <div class="w-full lg:w-1/2">
        <img src="{{ $playlist->picture }}" alt="{{ $playlist->name }}" class="rounded-lg w-full mb-6">
    </div>

    <form action="{{ route('playlists.update', $playlist->slug) }}" method="post" enctype="multipart/form-data"
        novalidate>
        @method('put')
        @include('playlists.partials._form-control',['submit' => "Update",])
    </form>
</x-app-layout>
