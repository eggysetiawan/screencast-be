<x-app-layout>
    <x-slot name="title">Edit Video</x-slot>
    <x-slot name="header">
        Edit Video : {{ $video->playlist->name . ' - ' . $video->title }}
    </x-slot>

    <form action="{{ route('videos.update', $video->unique_video_id) }}" method="post" novalidate>
        @method('put')
        @include('videos.partials._form-control',['submit' => 'Update',])
    </form>
</x-app-layout>
