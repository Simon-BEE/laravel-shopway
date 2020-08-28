<?php

namespace App\Http\Controllers\Admin\Products;

use App\Models\Products\Product;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function index()
    {
        return view('admin.products.index');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'product' => $product->load([
                'categories', 
                'product_options.color', 
                'product_options.images', 
                'product_options.material', 
                'product_options.sizes'
            ]),
        ]);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with([
            'type' => 'success',
            'message' => 'Product has been removed.'
        ]);
    }
}
