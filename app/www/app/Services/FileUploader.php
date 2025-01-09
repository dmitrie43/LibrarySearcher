<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

final class FileUploader
{
    const string FOLDER = 'storage';

    public static function uploadImage(UploadedFile $image): string
    {
        $filename = Str::random(10).'.'.$image->extension();
        $image->storeAs(self::FOLDER.'/', $filename);

        return self::FOLDER.'/'.$filename;
    }
}
