<?php

namespace App\Policies;

use App\Models\Orders\Order;
use App\Models\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Users\User  $user
     * @param  \App\Models\Orders\Order  $order
     * @return mixed
     */
    public function view(User $user, Order $order)
    {
        return $user->id === $order->user_id ? true : abort(404);
    }
}
