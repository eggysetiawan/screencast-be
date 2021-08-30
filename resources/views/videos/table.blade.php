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
                <x-th>Intro</x-th>
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
                        <span class="uppercase semi-bold text-xs">{{ $item->is_intro ? 'Yes' : 'No' }}</span>
                    </x-td>

                    <x-td>
                        <x-edit-anchor href="{{ route('videos.edit', $item->unique_video_id) }}">
                            Edit
                        </x-edit-anchor>
                        <div x-data="{open: false}" class="inline">
                            <x-modal state="open" x-show="open" headerClass="bg-blue-800">
                                <x-slot name="header">
                                    {{ __('Are you sure want to delete?') }}
                                </x-slot>
                                <div class="mb-6">
                                    <h4 class="text-lg capitalize">{{ $item->title }}</h4>
                                    <span class="text-xs uppercase text-gray-600">
                                        Episode {{ $item->episode }}
                                        -
                                        Runtime {{ $item->runtime }}
                                    </span>
                                </div>
                                <x-slot name="footer">
                                    <form action="{{ route('videos.destroy', $item->unique_video_id) }}"
                                        method="post" class="inline mr-4">
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

                                </x-slot>



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
        {{ $videos->links() }}
    </div>
</x-app-layout>
