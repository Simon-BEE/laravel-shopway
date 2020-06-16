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
        return view('welcome', [
            'products' => Product::with('references')->inRandomOrder()->take(12)->get(),
        ]);
    }
}
