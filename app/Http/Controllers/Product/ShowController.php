<?php

namespace App\Http\Controllers\Product;

use App\Models\Products\Product;
use App\Http\Controllers\Controller;
use App\Models\Products\Size;

class ShowController extends Controller
{
    public function __invoke(Product $product)
    {
        $allSizes = Size::all();

        return view('products.show', [
            'product' => $product->load(['images', 'product_options']),
            'sizes' => $allSizes,
        ]);
    }
}
