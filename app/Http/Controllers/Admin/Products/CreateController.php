<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;

class CreateController extends Controller
{
    public function create()
    {
        return view('admin.products.create');
    }

    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated();
        $references = array_pop($validatedData);



        $product = Product::create($validatedData);
        foreach ($references as $key => $reference) {
            $product->references()->create($reference);
        }

        return redirect()->route('admin.products.index')->with([
            'type' => 'success',
            'message' => 'Product has been created.'
        ]);
    }
}
