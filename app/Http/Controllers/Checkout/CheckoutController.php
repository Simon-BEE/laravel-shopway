<?php

namespace App\Http\Controllers\Checkout;

use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\{User, Order, Payment, Cart as CartModel};
use App\Helpers\Cart;
use App\Mail\ConfirmOrderMail;
use App\Http\Controllers\Controller;
use App\Services\Cart\CartCalculator;
use App\Repository\OrderProcessRepository;
use App\Notifications\NewOrderNotification;

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
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $clientSecret = PaymentIntent::create([
            'amount' => app(CartCalculator::class)->totalWithTax() + Cart::shippingPrice(),
            'currency' => config('cart.currency_iso'),
            'metadata' => [
                'user_id' => auth()->id(),
            ],
        ])->client_secret;

        return response()->json([
            'clientSecret' => $clientSecret
        ]);
    }

    /**
     * After payment was processed, store in DB order
     */
    public function storingOrder(OrderProcessRepository $orderProcessRepository)
    {
        $order = $orderProcessRepository->storeOrder();

        try {
            $orderProcessRepository->storeOrderItems($order);
    
            $orderProcessRepository->storePayments($order, request()->paymentIntent, Payment::STRIPE_TYPE);
        } catch (\Exception $e) {
            $this->saveCartInDatabase($order);
            
            // session()->put('checkout_error', 'error');
            // return response()->json([
            //     'success' => false,
            // ], 500);
        }

        Mail::to(auth()->user())->queue(new ConfirmOrderMail(auth()->user(), $order));

        User::admins()->each(function ($admin) use ($order){
            $admin->notify(new NewOrderNotification($order));
        });

        Cart::clear();

        session()->put('checkout_success', $order->id);

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

    private function saveCartInDatabase(Order $order)
    {
        CartModel::create([
            'user_id' => auth()->id(),
            'order_id' => $order->id,
            'content' => serialize(session('cart')),
        ]);
    }
}
