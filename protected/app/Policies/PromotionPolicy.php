<?php

namespace App\Policies;

use App\User;
use App\Promotion;
use Illuminate\Auth\Access\HandlesAuthorization;

class PromotionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the promotion.
     *
     * @param  \App\User  $user
     * @param  \App\Promotion  $promotion
     * @return mixed
     */
    public function view(User $user, Promotion $promotion)
    {
        //
    }

    /**
     * Determine whether the user can create promotions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {

    }

    /**
     * Determine whether the user can update the promotion.
     *
     * @param  \App\User  $user
     * @param  \App\Promotion  $promotion
     * @return mixed
     */
    public function update(User $user, Promotion $promotion)
    {
    }

    /**
     * Determine whether the user can delete the promotion.
     *
     * @param  \App\User  $user
     * @param  \App\Promotion  $promotion
     * @return mixed
     */
    public function delete(User $user, Promotion $promotion)
    {
        //
    }
}
