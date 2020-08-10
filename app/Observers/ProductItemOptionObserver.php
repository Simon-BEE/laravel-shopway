<?php

namespace App\Observers;

use App\Models\ProductItemOption;

class ProductItemOptionObserver
{
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
}
