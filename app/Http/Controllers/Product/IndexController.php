<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('products.index');
    }
}
