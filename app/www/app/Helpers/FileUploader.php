<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

final class FileUploader
{
    const string IMAGE_PATH = 'storage/images';

    const string AVATAR_PATH = 'storage/avatars';

    const string BOOK_FILE_PATH = 'storage/books/files';

    const string BOOK_COVER_PATH = 'storage/books/covers';

    public static function upload(UploadedFile $file, string $path): string
    {
        $filename = self::getFilename($file);
        Storage::putFileAs($path, $file, $filename);

        return $path.'/'.$filename;
    }

    private static function getFilename(UploadedFile $file): string
    {
        return Str::random(10).'.'.$file->extension();
    }
}
