<?php

namespace App\Observers;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageObserver
{
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
        Storage::disk('products')->delete($image->filename);
    }
}
