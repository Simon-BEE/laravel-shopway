<?php

namespace App\Observers;

use App\Models\ProductItemOption;
use App\Traits\Upload\ImageUpload;

class ProductItemOptionObserver
{
    use ImageUpload;

    /**
     * Handle the product item option "created" event.
     *
     * @param  \App\Models\ProductItemOption  $productItemOption
     * @return void
     */
    public function created(ProductItemOption $productItemOption)
    {
        $productItemOption->product->update([
            'active' => $productItemOption->product->quantity > 1,
        ]);
    }

    public function deleting(ProductItemOption $productItemOption)
    {
        $productItemOption->images->each(function ($image){
            $image->delete();
        });
    }
}
