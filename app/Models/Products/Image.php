<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

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
        return Image::where('product_option_id', $productId)->where('is_main', true)->first();
    }

    /**
     * ? RELATIONS
     */

    public function product_option()
    {
        return $this->belongsTo(ProductOption::class);
    }
}
