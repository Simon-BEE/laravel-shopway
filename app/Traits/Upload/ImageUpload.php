<?php

namespace App\Traits\Upload;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait ImageUpload
{
    /**
     * Remove a file in storage disk associate
     *
     * @param string $fileName
     * @param string $disk
     * @return boolean
     */
    public function removeImage(string $fileName, string $disk = 'public'): bool
    {
        return Storage::disk($disk)->delete($fileName);
    }

    /**
     * Store an image in storage disk associate and return its filename
     *
     * @param UploadedFile $file
     * @param string $disk
     * @return string
     */
    public function storeImage(UploadedFile $file, string $disk = 'public'): string
    {
        $fileNameWithExtension = Str::random(24) . '.' . strtolower($file->getClientOriginalExtension());

        Storage::disk($disk)->putFileAs('', $file, $fileNameWithExtension);

        return $fileNameWithExtension;
    }
}
