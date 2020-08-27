<?php

namespace App\Http\Controllers;

use App\Models\Products\Product;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    /**
     * Homepage view with some random products
     *
     * @return View
     */
    public function __invoke(): View
    {
        $products = auth()->check() 
            ? Product::active()->randomProducts()->with(['product_options', 'images', 'wishes'])->get() 
            : Product::active()->randomProducts()->with(['product_options', 'images'])->get();

        return view('welcome', [
            'products' => $products,
        ]);
    }
}
