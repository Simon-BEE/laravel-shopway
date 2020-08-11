<?php

namespace App\Http\Controllers\Product;

use App\Models\Option;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ShowController extends Controller
{
    public function __invoke(Product $product)
    {

        // dd($product->hasSize(1));

        $allSizes = Option::where('option_type_id', Option::SIZE_OPTION)->get();

        return view('products.show', [
            'product' => $product->load(['images', 'product_options']),
            'sizes' => $allSizes,
        ]);
    }
}
