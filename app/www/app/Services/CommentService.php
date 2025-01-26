<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CommentService
{
    /**
     * @param Book|int $book
     * @return Collection
     */
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
