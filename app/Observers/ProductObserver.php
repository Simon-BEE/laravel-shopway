<?php

namespace App\Observers;

use App\Models\Products\Product;
use Illuminate\Support\Str;
use App\Traits\Upload\ImageUpload;

class ProductObserver
{
    use ImageUpload;

    /**
     * Handle the product "creating" event.
     *
     * @param  \App\Models\Products\Product  $product
     * @return void
     */
    public function creating(Product $product)
    {
        $product->slug = Str::slug($product->name);
        $product->refreshStatus();
    }

    /**
     * Handle the product "updating" event.
     *
     * @param  \App\Models\Products\Product  $product
     * @return void
     */
    public function updating(Product $product)
    {
        $product->refreshStatus();
    }

    /**
     * Handle the product "deleting" event.
     *
     * @param  \App\Models\Products\Product  $product
     * @return void
     */
    public function deleting(Product $product)
    {
        foreach ($product->images as $image) {
            $image->delete();
        }
    }
}
