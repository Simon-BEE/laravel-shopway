<?php

namespace App\Http\Controllers\Checkout;

use App\Events\OrderPerformed;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Http\Controllers\Controller;
use App\Helpers\Cart;
use App\Services\Cart\CartCalculator;
use App\Repository\OrderProcessRepository;
use App\Models\Orders\Order;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.index');
    }

    /**
     * Generate a payment intent to stripe and return its client secret id
     */
    public function paymentIntent()
    {
        Stripe::setApiKey(config('shop.stripe.secret_key'));

        try {
            $clientSecret = PaymentIntent::create([
                'amount' => app(CartCalculator::class)->totalWithTax() + Cart::shippingPrice(),
                'currency' => config('cart.currency_iso'),
                'metadata' => [
                    'user_id' => auth()->id(),
                ],
            ])->client_secret;
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'clientSecret' => $clientSecret
        ]);
    }

    /**
     * After payment was processed, store in DB order
     */
    public function storingOrder(OrderProcessRepository $orderProcessRepository)
    {
        event(new OrderPerformed(auth()->user()));

        Cart::clear();

        return response()->json([
            'success' => true,
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
        if (!session('checkout_error')) {
            return redirect()->route('welcome');
        }

        session()->forget('checkout_error');

        return view('checkout.error');
    }
}
