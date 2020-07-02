<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function edit(Product $product)
    {
        // dd($product);
        return view('admin.products.edit', [
            'product' => $product,
        ]);
    }

    public function update()
    {
        # code...
    }
}
