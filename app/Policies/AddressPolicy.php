<?php

namespace App\Policies;

use App\Models\Users\Address;
use App\Models\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddressPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Users\User  $user
     * @param  \App\Models\Users\Address  $address
     * @return mixed
     */
    public function update(User $user, Address $address)
    {
        return $user->id === $address->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Users\User  $user
     * @param  \App\Models\Users\Address  $address
     * @return mixed
     */
    public function delete(User $user, Address $address)
    {
        return $user->id === $address->user_id;
    }
}
