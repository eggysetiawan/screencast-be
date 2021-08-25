<x-app-layout>
    <x-slot name="title">
        Create Playlist
    </x-slot>

    <x-slot name="header">
        Create Playlist
    </x-slot>

    <form action="{{ route('playlists.store') }}" method="post" enctype="multipart/form-data" novalidate>
        @include('playlists.partials._form-control')
    </form>
</x-app-layout>
