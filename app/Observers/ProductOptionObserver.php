<?php

namespace App\Observers;

use App\Models\Products\ProductOption;
use App\Traits\Upload\ImageUpload;

class ProductOptionObserver
{
    use ImageUpload;

    /**
     * Handle the product item option "created" event.
     *
     * @param  \App\Models\Products\ProductOption  $productOption
     * @return void
     */
    public function created(ProductOption $productOption)
    {
        $productOption->product->refreshStatus();
    }

    /**
     * Handle the product "updated" event.
     *
     * @param  \App\Models\Products\Product  $product
     * @return void
     */
    public function updated(ProductOption $productOption)
    {
        $productOption->product->refreshStatus();
    }

    public function deleting(ProductOption $productOption)
    {
        $productOption->images->each(function ($image){
            $image->delete();
        });
    }
}
