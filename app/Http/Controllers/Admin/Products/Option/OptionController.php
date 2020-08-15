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
        // if ($product->id !== $latestProduct = Product::last()->id) {
        //     return redirect()->route('admin.products.options.create', $latestProduct);
        // }

        // dd(Option::allSizes()->get()->pluck('id')->toArray());

        return view('admin.products.options.create', [
            'product' => $product,
            'sizes' => Option::allSizes()->get(),
            'materials' => Option::allMaterials()->get(),
            'colors' => Option::allColors()->get(),
        ]);
    }

    public function store(StoreProductOptionRequest $request)
    {
        $validatedData = $request->validated();
        $images = Arr::pull($validatedData, 'images');
        $sizes = Arr::pull($validatedData, 'sizes');
        $color = Arr::pull($validatedData, 'color');
        $material = Arr::pull($validatedData, 'material');

        $productOption = ProductItemOption::create($validatedData);

        $productOption->options()->sync(array_merge([$color, $material], $sizes));

        collect($images)->each(function ($image) use ($productOption){
            $filename = $this->storeImage($image, 'products');
            $productOption->images()->create([
                'filename' => $filename,
            ]);
        });

        if (isset(request()->another_form)) {
            return redirect()->route('admin.products.options.create', request()->product_id)->with([
                'type' => 'success',
                'message' => 'Product option has been added.'
            ]);
        }

        return redirect()->route('admin.products.index')->with([
            'type' => 'success',
            'message' => 'Product option has been added.'
        ]);
    }
}
