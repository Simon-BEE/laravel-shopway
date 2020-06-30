<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;

class DestroyController extends Controller
{
    public function __invoke(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with([
            'type' => 'success',
            'message' => 'Product has been removed.'
        ]);
    }
}
