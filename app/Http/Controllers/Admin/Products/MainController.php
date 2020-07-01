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

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with([
            'type' => 'success',
            'message' => 'Product has been removed.'
        ]);
    }
}
