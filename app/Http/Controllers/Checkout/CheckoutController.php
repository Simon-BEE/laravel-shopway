<?php

namespace App\Http\Controllers\Checkout;

use Stripe\Stripe;
use App\Helpers\Cart;
use Stripe\PaymentIntent;
use Illuminate\Support\Arr;
use App\Services\Cart\CartManager;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.index', [
            'cartProducts' => session('cart'),
            'totalWithTax' => Cart::totalWithTax(),
        ]);
    }

    public function payment()
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        PaymentIntent::create([
            'amount' => app(CartManager::class)->totalWithTax(),
            'currency' => config('cart.currency_iso'),
            'metadata' => [
                'user_id' => auth()->id(),
            ],
        ]);

        return response()->json();
    }

    public function successful()
    {
        return view('checkout.success');
    }

    public function error()
    {
        return view('checkout.error');
    }
}
