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

        //TODO: images

        $product = Product::create($validatedData);

        return redirect()->route('admin.products.index')->with([
            'type' => 'success',
            'message' => 'Product has been created.'
        ]);
    }
}
