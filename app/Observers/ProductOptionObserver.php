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
        // $productOption->product->update([
        //     'active' => $productOption->product->quantity > 1,
        // ]);
    }

    public function deleting(ProductOption $productOption)
    {
        $productOption->images->each(function ($image){
            $image->delete();
        });
    }
}
