<x-app-layout>
    <x-slot name="title">Add Video</x-slot>
    <x-slot name="header">
        New Video : {{ $playlist->name }}
    </x-slot>

    <form action="{{ route('videos.store', $playlist->slug) }}" method="post" novalidate>
        @include('videos.partials._form-control')
    </form>
</x-app-layout>
