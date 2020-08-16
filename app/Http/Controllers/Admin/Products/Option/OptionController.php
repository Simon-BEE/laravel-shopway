<?php

namespace App\Http\Controllers\Admin\Products\Option;

use Illuminate\Http\Request;
use App\Traits\Upload\ImageUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductOptionRequest;
use App\Models\Option;
use App\Models\Product;
use App\Models\ProductItemOption;
use Illuminate\Support\Arr;

class OptionController extends Controller
{
    use ImageUpload;

    public function create(Product $product)
    {
        return view('admin.products.options.create', [
            'product' => $product,
            'sizes' => Option::allSizes()->get(),
            'materials' => Option::allMaterials()->get(),
            'colors' => Option::allColors()->get(),
        ]);
    }

    public function store(StoreProductOptionRequest $request, Product $product)
    {
        $validatedData = $request->validated();
        $images = Arr::pull($validatedData, 'images');
        $sizes = Arr::pull($validatedData, 'sizes');
        $color = Arr::pull($validatedData, 'color');
        $material = Arr::pull($validatedData, 'material');

        $productOption = $product->product_options()->create($validatedData);

        $productOption->options()->sync(array_merge([$color, $material], $sizes));

        collect($images)->each(function ($image) use ($productOption){
            $filename = $this->storeImage($image, 'products');
            $productOption->images()->create([
                'filename' => $filename,
            ]);
        });

        if (isset(request()->another_form)) {
            return redirect()->route('admin.products.options.create', $product)->with([
                'type' => 'success',
                'message' => 'Product option has been added.'
            ]);
        }

        return redirect()->route('admin.products.edit', $product)->with([
            'type' => 'success',
            'message' => 'Product option has been added.'
        ]);
    }

    public function edit(Product $product, ProductItemOption $option)
    {
        return view('admin.products.options.edit', [
            'product' => $product,
            'productOption' => $option,
        ]);
    }

    public function destroy(Product $product, ProductItemOption $option)
    {
        $option->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Product option has been removed.'
        ]);
    }
}
