<x-app-layout>
    <x-slot name="title">
        Table Playlist
    </x-slot>

    <x-slot name="header">
        Your Playlist
    </x-slot>

    <x-table>
        <thead>
            <tr>
                <x-th>#</x-th>
                <x-th>Name</x-th>
                <x-th>Published</x-th>
                <x-th>Action</x-th>
            </tr>
        </thead>
        <tbody>
            @foreach ($playlists as $i => $item)
                {{-- @dump($i.' => '.$item->name.' + '.$playlists->firstItem()) --}}
                <tr>
                    <x-td>{{ $i + $playlists->firstItem() }}</x-td>
                    <x-td>{{ $item->name }}</x-td>
                    <x-td>{{ $item->created_at->format('d F, Y') }}
                    </x-td>
                    <x-td>
                        <a class="text-blue-500 hover:text-blue-900 font-medium underline uppercase text-xs"
                            href="{{ route('playlists.edit', $item->slug) }}">Edit
                        </a>
                        <div x-data="{open: false}">
                            <x-modal state="open" x-show="open" title="Are you sure want to delete?"
                                headerClass="bg-blue-800">
                                <form action="{{ route('playlists.destroy', $item->slug) }}" method="post"
                                    class="inline mr-4">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                        class="rounded-lg px-4 py-2 text-white bg-red-500 hover:bg-red-900 font-medium">
                                        Yes,
                                        Delete it!</button>
                                </form>
                                <button @click="open = false"
                                    class="rounded-lg px-4 py-2 text-white bg-green-500 hover:bg-green-900 font-medium focus:outline-none">
                                    I don't think so.
                                </button>

                            </x-modal>
                            <button @click="open = true"
                                class="text-red-500 hover:text-red-900 font-medium underline uppercase text-xs focus:outline-none">Delete
                            </button>
                        </div>
                    </x-td>

                </tr>
            @endforeach
        </tbody>

    </x-table>
    <div class="my-4">
        {{ $playlists->links() }}
    </div>
</x-app-layout>
