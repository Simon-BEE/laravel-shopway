<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $guarded = ['id'];

    public static function booted()
    {
        static::creating(function ($image){
            if (!(new static)->getMainImageByProduct($image->product->id)) {
                $image->is_main = true;
            };
        });

        static::deleted(function ($image){
            Storage::disk('products')->delete($image->filename);
        });
    }

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
        return Image::where('product_id', $productId)->where('is_main', true)->first();
    }

    /**
     * ? RELATIONS
     */

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
