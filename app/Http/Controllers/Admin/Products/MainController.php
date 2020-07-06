<?php

namespace App\Http\Controllers\Admin\Products;

use App\Models\Product;
use App\Http\Controllers\Controller;

class MainController extends Controller
{

    public function index()
    {
        return view('admin.products.index');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'product' => $product->load('images'),
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
