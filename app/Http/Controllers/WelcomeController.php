<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
        $products = auth()->check() ? Product::randomProducts()->with(['images', 'wishes'])->get() : Product::randomProducts()->with('images')->get();

        return view('welcome', [
            'products' => $products,
        ]);
    }
}
