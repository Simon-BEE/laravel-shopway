<?php

namespace App\Http\Controllers\Product;

use App\Models\Option;
use App\Models\Products\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ShowController extends Controller
{
    public function __invoke(Product $product)
    {
        $allSizes = Option::allSizes()->get();

        return view('products.show', [
            'product' => $product->load(['images', 'product_options']),
            'sizes' => $allSizes,
        ]);
    }
}
