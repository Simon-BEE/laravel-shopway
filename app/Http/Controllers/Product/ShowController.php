<?php

namespace App\Http\Controllers\Product;

use App\Models\Products\Product;
use App\Http\Controllers\Controller;
use App\Models\Products\Size;

class ShowController extends Controller
{
    public function __invoke(Product $product)
    {
        abort_if($product->quantity < 1, 404, 'Product unavailable');

        $allSizes = Size::all();

        return view('products.show', [
            'product' => $product->load(['images', 'product_options.sizes', 'product_options.material']),
            'sizes' => $allSizes,
        ]);
    }
}
