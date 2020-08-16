<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Traits\Upload\ImageUpload;

class ProductObserver
{
    use ImageUpload;

    /**
     * Handle the product "creating" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function creating(Product $product)
    {
        $product->slug = Str::slug($product->name);
        $product->active = $product->quantity > 1;
    }

    /**
     * Handle the product "updating" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updating(Product $product)
    {
        $product->active = $product->quantity > 0;
    }

    /**
     * Handle the product "deleting" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleting(Product $product)
    {
        foreach ($product->images as $image) {
            $image->delete();
        }
    }
}
