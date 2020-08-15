<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Arr;

class CreateController extends Controller
{
    public function create()
    {
        return view('admin.products.create', [
            'categories' => Category::all(),
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated();
        $categories = Arr::pull($validatedData, 'categories');

        $product = Product::create($validatedData);

        $product->categories()->sync($categories);

        return redirect()->route('admin.products.options.create', $product)->with([
            'type' => 'success',
            'message' => 'Product has been created, you need to add some options now.'
        ]);
    }
}
