<x-app-layout>
    <x-slot name="title">
        Create Tag
    </x-slot>
    <x-slot name="header">Create Tag</x-slot>

    <form action="{{ route('tags.store') }}" method="post">
        @include('tags.partials._form-control')
    </form>
</x-app-layout>
