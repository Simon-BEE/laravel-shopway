<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = ['id'];

    public function setAsMain()
    {
        $oldMainImage = $this->getMainImageByProduct($this->product_option->id);

        $oldMainImage->update([
            'is_main' => false,
        ]);

        $this->update([
            'is_main' => true,
        ]);
    }

    public function getMainImageByProduct(int $productOptionId)
    {
        return Image::where('product_option_id', $productOptionId)->where('is_main', true)->first();
    }

    /**
     * ? RELATIONS
     */

    public function product_option()
    {
        return $this->belongsTo(ProductOption::class);
    }
}
