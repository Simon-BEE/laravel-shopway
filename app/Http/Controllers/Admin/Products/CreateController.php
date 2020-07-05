<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Traits\Upload\ImageUpload;

class CreateController extends Controller
{
    use ImageUpload;

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated();
        $images = array_pop($validatedData);

        $product = Product::create($validatedData);

        foreach ($images as $image) {
            $filename = $this->storeImage($image, 'products');
            $product->images()->create([
                'filename' => $filename,
            ]);
        }

        return redirect()->route('admin.products.index')->with([
            'type' => 'success',
            'message' => 'Product has been created.'
        ]);
    }
}
