<?php

namespace App\Helpers;

use App\Models\Reference;

class ProductHelper
{
    /**
     * Get product route by reference product id
     *
     * @param integer $id product reference id
     * @return void
     */
    public static function getRouteByReference(int $id)
    {
        return route('products.show', Reference::findOrFail($id)->product);
    }
}
