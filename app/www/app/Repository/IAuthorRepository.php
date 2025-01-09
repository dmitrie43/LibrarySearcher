<?php

namespace App\Repository;

use App\Models\Author;
use Illuminate\Http\UploadedFile;

interface IAuthorRepository
{
    public function uploadPhoto(UploadedFile $image);

    public function removePhoto(Author $author);
}
