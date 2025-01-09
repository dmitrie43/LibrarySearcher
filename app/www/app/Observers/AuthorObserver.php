<?php

namespace App\Observers;

use App\Models\Author;

class AuthorObserver
{
    public function deleted(Author $author): void
    {
        $author->removeImages();
    }
}
