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
                    <x-td><a class="text-blue-500 hover:text-blue-600 font-medium underline uppercase text-xs"
                            href="{{ route('playlists.edit', $item->slug) }}">Edit</a></x-td>
                </tr>
            @endforeach
        </tbody>
    </x-table>
    <div class="my-4">
        {{ $playlists->links() }}
    </div>
</x-app-layout>
