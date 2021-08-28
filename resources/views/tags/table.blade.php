<x-app-layout>
    <x-slot name="title">
        Tags Table
    </x-slot>
    <x-slot name="Header">
        Tags Table
    </x-slot>

    <x-table>
        <thead>
            <tr>
                <x-th>#</x-th>
                <x-th>Name</x-th>
                <x-th>Playlist</x-th>
                @can('modify tags')
                    <x-th>Action</x-th>
                @endcan
            </tr>
        </thead>
        <tbody>

            @foreach ($tags as $i => $tag)
                <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-gray-300' : '' }}">
                    <x-td>{{ $i + $tags->firstItem() }}</x-td>
                    <x-td>{{ $tag->name }}</x-td>
                    <x-td>{{ $tag->playlists_count }}</x-td>
                    @can('modify tags')
                        <x-td>
                            <x-edit-anchor href="{{ route('tags.edit', $tag->slug) }}">
                                Edit
                            </x-edit-anchor>
                            <div x-data=" {open: false}" class="inline">
                                <x-modal state="open" x-show="open" title="Are you sure want to delete?"
                                    headerClass="bg-blue-800">
                                    <form action="{{ route('tags.destroy', $tag->slug) }}" method="post"
                                        class="inline mr-4">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            class="rounded-lg px-4 py-2 text-white bg-red-500 hover:bg-red-900 font-medium">
                                            Yes,
                                            Delete it!</button>
                                    </form>
                                    <button @click="open = false"
                                        class="rounded-lg px-4 py-2 text-white bg-yellow-400 hover:bg-yellow-500 font-medium focus:outline-none">
                                        I don't think so.
                                    </button>

                                </x-modal>
                                <button @click="open = true"
                                    class="text-red-500 hover:text-red-900 font-medium underline uppercase text-xs focus:outline-none">Delete
                                </button>
                        </x-td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </x-table>
    <div class="mt-2">{{ $tags->links() }}</div>
</x-app-layout>
