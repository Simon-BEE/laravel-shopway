<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\Cart;

class CartIsNotEmpty
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
        if (empty(Cart::content())) {
            return redirect()->route('welcome')->with([
                'type' => 'error',
                'message' => __('You need some products in your cart before.'),
            ]);
        }

        return $next($request);
    }
}
