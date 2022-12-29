<?php

namespace App\Repository\Eloquent;

use App\Models\Author;
use App\Repository\IAuthorRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AuthorRepository extends BaseRepository implements IAuthorRepository
{
    public string $photo = '';

    /**
     * AuthorRepository constructor.
     * @param Author $model
     */
    public function __construct(Author $model)
    {
        parent::__construct($model);
    }

    /**
     * @param \Illuminate\Http\UploadedFile $image
     */
    public function uploadPhoto(UploadedFile $image) : void
    {
        if ($image == null) return;
        $filename = Str::random(10) . '.' . $image->extension();
        $image->storeAs('storage/', $filename);
        $this->photo = 'storage/'.$filename;
    }

    /**
     * @param Author $author
     */
    public function removePhoto(Author $author) : void
    {
        if (!empty($author->photo)) {
            Storage::delete($author->photo);
        }
    }

    /**
     * @param Author $author
     */
    public function remove(Author $author) : void
    {
        $this->removePhoto($author);
        $author->delete();
    }
}
