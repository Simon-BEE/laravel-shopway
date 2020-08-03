<?php

namespace App\Http\Controllers\Checkout;

use Stripe\Stripe;
use App\Helpers\Cart;
use Stripe\PaymentIntent;
use App\Services\Cart\CartManager;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repository\PaymentOrderProcessRepository;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.index', [
            'cartProducts' => Cart::content(),
            'totalWithTax' => Cart::totalWithTax(),
        ]);
    }

    public function paymentIntent()
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $clientSecret = PaymentIntent::create([
            'amount' => app(CartManager::class)->totalWithTax(),
            'currency' => config('cart.currency_iso'),
            'metadata' => [
                'user_id' => auth()->id(),
            ],
        ])->client_secret;

        return response()->json([
            'clientSecret' => $clientSecret
        ]);
    }

    public function paymentProcess(PaymentOrderProcessRepository $paymentOrderProcessRepository)
    {
        $order = $paymentOrderProcessRepository->storeOrder(request()->paymentIntent);

        $paymentOrderProcessRepository->storeOrderItems($order);

        $paymentOrderProcessRepository->storePayments($order);

        Cart::clear();

        session()->put('checkout_success', $order->id);

        return response()->json([
            'success' => true
        ]);
    }

    public function successful()
    {
        if (!session('checkout_success')) {
            return redirect()->route('welcome');
        }

        $order = Order::find(session('checkout_success'));
        
        session()->forget('checkout_success');

        return view('checkout.success', compact('order'));
    }

    public function error()
    {
        return view('checkout.error');
    }
}