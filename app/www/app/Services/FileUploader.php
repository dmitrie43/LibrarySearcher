<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

final class FileUploader
{
    public static function uploadImage(UploadedFile $image): string
    {
        $filename = self::getFilename($image);
        Storage::putFileAs(config('app.paths.images'), $image, $filename);

        return config('app.paths.images').'/'.$filename;
    }

    public static function uploadAvatar(UploadedFile $avatar): string
    {
        $filename = self::getFilename($avatar);
        Storage::putFileAs(config('app.paths.avatars'), $avatar, $filename);

        return config('app.paths.avatars').'/'.$filename;
    }

    private static function getFilename(UploadedFile $file): string
    {
        return Str::random(10).'.'.$file->extension();
    }
}
