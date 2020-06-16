<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Reference;
use Illuminate\View\View;
use App\Services\Cart\CartManager;

class WelcomeController extends Controller
{
    /**
     * Homepage view with some random products
     *
     * @return View
     */
    public function __invoke(): View
    {
        $cartService = new CartManager();
        $cartService->add(Reference::find(11));
        // dd(session('cart'));
        // session()->flush();

        return view('welcome', [
            'products' => Product::with('references')->inRandomOrder()->take(12)->get(),
        ]);
    }
}
