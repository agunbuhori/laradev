<?php

namespace App\Policies;

use App\User;
use App\Broadcast;
use Illuminate\Auth\Access\HandlesAuthorization;

class BroadcastPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the broadcast.
     *
     * @param  \App\User  $user
     * @param  \App\Broadcast  $broadcast
     * @return mixed
     */
    public function view(User $user, Broadcast $broadcast)
    {
        //
    }

    /**
     * Determine whether the user can create broadcasts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the broadcast.
     *
     * @param  \App\User  $user
     * @param  \App\Broadcast  $broadcast
     * @return mixed
     */
    public function update(User $user, Broadcast $broadcast)
    {
        return $broadcast->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the broadcast.
     *
     * @param  \App\User  $user
     * @param  \App\Broadcast  $broadcast
     * @return mixed
     */
    public function delete(User $user, Broadcast $broadcast)
    {
        //
    }
}
