@csrf
<div class="mb-6 w-full lg:w-1/2">
    <x-label for="name" :value="__('Name')" />

    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name') ?? $tag->name" required />
    @error('name')
        <span class="text-red-500 mt-2">{{ $message }}</span>
    @enderror
</div>
<x-button>{{ $submit ?? 'Create' }}</x-button>
