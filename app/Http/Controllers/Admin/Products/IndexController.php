<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('admin.products.index', [
            'products' => Product::all(),
        ]);
    }
}
