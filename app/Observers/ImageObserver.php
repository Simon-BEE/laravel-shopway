<?php

namespace App\Observers;

use App\Models\Image;
use App\Traits\Upload\ImageUpload;
use Illuminate\Support\Facades\Storage;

class ImageObserver
{
    use ImageUpload;
    /**
     * Handle the image "created" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function created(Image $image)
    {
        if (!$image->getMainImageByProduct($image->product->id)) {
            $image->is_main = true;
            $image->save();
        };
    }

    /**
     * Handle the image "deleted" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function deleting(Image $image)
    {
        // Just save placeholder pictures
        if ($image->filename !== 'product_1.jpg' && $image->filename !== 'product_2.jpg') {
            $this->removeImage($image->filename, 'products');
        }
    }
}
