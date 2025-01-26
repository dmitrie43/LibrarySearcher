<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Support\Collection;

class CommentService
{
    public function getBookComments(Book|int $book): Collection
    {
        if (is_int($book)) {
            $book = Book::query()->findOrFail($book);
        }

        return $book
            ->comments()
            ->where('is_approved', true)
            ->get();
    }
}
