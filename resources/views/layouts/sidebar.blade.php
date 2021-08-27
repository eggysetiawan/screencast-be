<div class="w-1/5 bg-blue-800 text-white min-h-screen px-4 py-6">
    <div class="mb-8">
        <header class="font-medium px-2 text-gray-300 text-xs uppercase">
            Main
        </header>
        <a href="{{ route('dashboard') }}" class="block px-2 py-2">Dashboard</a>
    </div>
    @can('create playlists')
        <div class="mb-8">
            <header class="font-medium px-2 text-gray-300 text-xs uppercase">
                Playlist
            </header>
            <a href="{{ route('playlists.create') }}" class="block px-2 py-2">Create</a>
            <a href="{{ route('playlists.table') }}" class="block px-2 py-2">Table</a>
        </div>
    @endcan

    @can('create tags')
        <div class="mb-8">
            <header class="font-medium px-2 text-gray-300 text-xs uppercase">
                Tags
            </header>
            <a href="#" class="block px-2 py-2">Create</a>
            <a href="#" class="block px-2 py-2">Table</a>
        </div>
    @endcan

    @can('show users')
        <div class="mb-5">
            <header class="font-medium px-2 text-gray-300 text-xs uppercase">
                User
            </header>
            <a href="#" class="block px-2 py-2">Table</a>
        </div>
    @endcan


    <div class="mb-5">

        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <a href="route('logout')" class="block px-2 py-2" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                {{ __('Log Out') }}
            </a>
        </form>
    </div>

</div>
