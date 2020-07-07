<?php

namespace App\Observers;

use App\Models\Image;
use App\Traits\Upload\ImageUpload;
use Illuminate\Support\Facades\Storage;

class ImageObserver
{
    use ImageUpload;
    /**
     * Handle the image "creating" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function creating(Image $image)
    {
        if (!$image->getMainImageByProduct($image->product->id)) {
            $image->is_main = true;
        };
    }

    /**
     * Handle the image "deleted" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function deleted(Image $image)
    {
        $this->removeImage($image->filename, 'products');
    }
}
