<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $guarded = ['id'];

    public function setAsMain()
    {
        $oldMainImage = $this->getMainImageByProduct($this->product->id);

        $oldMainImage->update([
            'is_main' => false,
        ]);

        $this->update([
            'is_main' => true,
        ]);
    }

    public function getMainImageByProduct(int $productId)
    {
        return Image::where('product_item_option_id', $productId)->where('is_main', true)->first();
    }

    /**
     * ? RELATIONS
     */

    public function product()
    {
        return $this->belongsTo(ProductItemOption::class, 'product_item_option_id');
    }
}
