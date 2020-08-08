<?php

namespace App\Http\Controllers\Checkout;

use Stripe\Stripe;
use App\Helpers\Cart;
use App\Helpers\Format;
use Stripe\PaymentIntent;
use App\Services\Cart\CartCalculator;
use App\Http\Controllers\Controller;
use App\Mail\ConfirmOrderMail;
use App\Models\Order;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use App\Repository\OrderProcessRepository;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function index()
    {
        $shippingFees = Cart::shipping();

        return view('checkout.index', [
            'cartProducts' => Cart::content(),
            'shippingFees' => Format::priceWithCurrency($shippingFees),
            'totalWithTaxAndShipping' => Format::priceWithCurrency(Cart::totalWithTaxRaw() + $shippingFees),
        ]);
    }

    /**
     * Generate a payment intent to stripe and return its client secret id
     */
    public function paymentIntent()
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $clientSecret = PaymentIntent::create([
            'amount' => app(CartCalculator::class)->totalWithTax() + Cart::shipping(),
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
        $order = $orderProcessRepository->storeOrder(request()->paymentIntent);

        if (!$order) {
            session()->put('checkout_error');

            return response()->json([
                'success' => false,
            ]);
        }

        $orderProcessRepository->storeOrderItems($order);

        $orderProcessRepository->storePayments($order);

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
}
