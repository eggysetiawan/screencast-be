<x-app-layout>
    <x-slot name="title">
        Edit Tag
    </x-slot>
    <x-slot name="header">Edit Tag : {{ $tag->name }}</x-slot>

    <form action="{{ route('tags.update', $tag->slug) }}" method="post">
        @method('put')
        @include('tags.partials._form-control',['submit' => 'Update',])
    </form>
</x-app-layout>
