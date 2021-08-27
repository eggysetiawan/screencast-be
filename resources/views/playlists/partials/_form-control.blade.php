@csrf
<div class="mb-6">
    <input type="file" name="thumbnail" id="thumbnail">
    @error('thumbnail')
        <div class="text-red-500 mt-2">{{ $message }}</div>
    @enderror
</div>
<div class="mb-6">
    <x-label for="name" :value="__('Name')" />

    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name') ?? $playlist->name"
        required />
    @error('name')
        <span class="text-red-500 mt-2">{{ $message }}</span>
    @enderror
</div>

<div class="mb-6">
    <x-label for="price" :value="__('Price')" />

    <x-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price') ?? $playlist->price"
        required />
    @error('price')
        <span class="text-red-500 mt-2">{{ $message }}</span>
    @enderror
</div>

<div class="mb-6">
    <x-label for="description" :value="__('Description')" />
    <x-textarea name="description" id="description">{{ old('description') ?? $playlist->description }}</x-textarea>
    @error('description')
        <span class="text-red-500 mt-2">{{ $message }}</span>
    @enderror
</div>

<div class="mb-6">
    <x-label for="tags" :value="__('Tag')" />
    <x-select name="tags[]" id="tags" multiple>
        @foreach ($tags as $id => $name)
            <option {{ $playlist->tags()->find($id) ? 'selected' : '' }} value="{{ $id }}">
                {{ $name }}</option>
        @endforeach
    </x-select>
    @error('tags')
        <span class="text-red-500 mt-2">{{ $message }}</span>
    @enderror
</div>
<x-button>{{ $submit ?? 'Create' }}</x-button>
