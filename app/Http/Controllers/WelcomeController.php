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
        $products = auth()->check() ? Product::randomProducts('references.wishes')->get() : Product::randomProducts()->get();

        return view('welcome', [
            'products' => $products,
        ]);
    }
}
