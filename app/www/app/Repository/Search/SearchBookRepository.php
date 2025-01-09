<?php

namespace App\Repository\Search;

use App\Models\Book;
use Illuminate\Support\Collection;

class SearchBookRepository implements ISearchBookRepository
{
    public function search(string $query): Collection
    {
        $book = new Book;

        return $book->defaultSearch($query);
    }
}
