<x-app-layout>
    <x-slot name="title">
        Create Playlist
    </x-slot>

    <form action="{{ route('playlists.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-6">
            <input type="file" name="thumbnail" id="thumbnail">
        </div>
        <div class="mb-6">
            <x-label for="name" :value="__('Name')" />

            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
        </div>

        <div class="mb-6">
            <x-label for="price" :value="__('Price')" />

            <x-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price')" required />
        </div>

        <div class="mb-6">
            <x-label for="description" :value="__('Description')" />
            <x-textarea name="description" id="description">{{ old('description') }}</x-textarea>
        </div>
        <x-button>Create</x-button>
    </form>
</x-app-layout>
