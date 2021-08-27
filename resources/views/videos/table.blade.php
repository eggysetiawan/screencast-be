<x-app-layout>
    <x-slot name="title">{{ $playlist->name }}'s video</x-slot>
    <x-slot name="header">
        Table of {{ $playlist->name }} content.
    </x-slot>

    <x-table>
        <thead>
            <tr>
                <x-th>#</x-th>
                <x-th>Title</x-th>
                <x-th>Action</x-th>
            </tr>
        </thead>
        <tbody>
            @foreach ($videos as $i => $item)
                {{-- @dump($i.' => '.$item->name.' + '.$playlists->firstItem()) --}}
                <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-gray-200 ' : 'bg-white ' }} ">
                    <x-td>{{ $i + $videos->firstItem() }}</x-td>
                    <x-td>{{ $item->title }} </x-td>

                    <x-td>
                        <a href="#">Edit</a>
                        <a href="#">Delete</a>
                    </x-td>

                </tr>
            @endforeach
        </tbody>

    </x-table>
    <div class="my-4">
        {{ $videos->links() }}
    </div>
</x-app-layout>
