<?php

namespace App\Observers;

use App\Models\Book;

class BookObserver
{
    public function deleted(Book $book): void
    {
        $book->removeImages();
        $book->removeFiles();
        $book->genres()->detach();
    }
}
