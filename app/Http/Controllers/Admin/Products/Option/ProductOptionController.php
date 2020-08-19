<?php

namespace App\Http\Controllers\Admin\Products\Option;

use App\Http\Controllers\Controller;
use App\Traits\Upload\ImageUpload;
use App\Http\Requests\StoreProductOptionRequest;
use App\Models\Products\{Size, Color, Product, Material, ProductOption};

class ProductOptionController extends Controller
{
    use ImageUpload;

    public function create(Product $product)
    {
        return view('admin.products.options.create', [
            'product' => $product,
            'sizes' => Size::all(),
            'materials' => Material::all(),
            'colors' => Color::all(),
        ]);
    }

    public function store(StoreProductOptionRequest $request, Product $product)
    {
        $validatedData = collect($request->validated());
        $images = $validatedData->pull('images');
        $quantities = $validatedData->pull('quantities');

        // $validatedData->forget('sizes');
        $productOption = $product->product_options()->create($validatedData->toArray());

        if (!empty($quantities)) {
            $sizesArray = $this->prepareSizeData($quantities);

            $productOption->sizes()->attach($sizesArray);
        }

        $this->attachAndPushImages($productOption, $images);

        // If user click on button to add another option
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

    public function edit(Product $product, ProductOption $option)
    {
        return view('admin.products.options.edit', [
            'product' => $product,
            'productOption' => $option,
        ]);
    }

    public function destroy(Product $product, ProductOption $option)
    {
        $option->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Product option has been removed.'
        ]);
    }

    /**
     * Prepare size data to attach to product option
     *
     * @param array $quantities
     * @return array
     */
    private function prepareSizeData(array $quantities): array
    {
        return collect(array_filter($quantities))->mapWithKeys(function ($quantity, $sizeId){
            return [$sizeId => ['quantity' => $quantity]];
        })->toArray();
    }

    /**
     * Store in DB and attach image to product option
     *
     * @param ProductOption $productOption
     * @param array $images
     * @return void
     */
    private function attachAndPushImages(ProductOption $productOption, array $images): void
    {
        collect($images)->each(function ($image) use ($productOption){
            $filename = $this->storeImage($image, 'products');
            $productOption->images()->create([
                'filename' => $filename,
            ]);
        });
    }
}
