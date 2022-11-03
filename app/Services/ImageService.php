<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Str;

/**
 * Class ImageService
 */
class ImageService
{
    /**
     * @note store files from request
     */
    public static function storeFiles($media, $folderName, $mediaName = 'default')
    {
        $mediaName = pathinfo($media->getClientOriginalName(), PATHINFO_FILENAME);

        $folderName = str_replace(' ', '-', $folderName)/*Str::slug($folderName, '-')*/;

        $folderName = $folderName.'/'.date('Y-m-d');
        $mediaName = $mediaName.'-'.Carbon::now()->microsecond;
        $mediaName = Str::slug($mediaName, '-').'.'.$media->getClientOriginalExtension();
        $media->storeAs($folderName, $mediaName);
        $path = 'storage/'.$folderName;
        $image = $path.'/'.$mediaName;

        return $image;
    }
}
