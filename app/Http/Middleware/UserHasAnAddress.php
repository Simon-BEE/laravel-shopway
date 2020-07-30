<?php

namespace App\Http\Middleware;

use Closure;

class UserHasAnAddress
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->addresses->isEmpty()) {
            return redirect()->route('users.addresses.create')->with([
                'type' => 'error',
                'message' => __('You need to create an address before continue.'),
            ]);
        }

        return $next($request);
    }
}
