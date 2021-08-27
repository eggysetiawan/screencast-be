<?php

namespace App\Policies\Screencast;

use App\Models\Screencast\Playlist;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlaylistPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function update(User $user, Playlist $playlist)
    {
        return $user->id === $playlist->user_id;
    }

    public function delete(User $user, Playlist $playlist)
    {
        return $user->id === $playlist->user_id;
    }
}
