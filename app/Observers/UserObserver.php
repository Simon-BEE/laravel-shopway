<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Str;

class UserObserver
{
    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        $user->update([
            'firstname' => null,
            'lastname' => null,
            'email' => Str::random(44),
            'password' => Str::random(10),
        ]);
    }
}
