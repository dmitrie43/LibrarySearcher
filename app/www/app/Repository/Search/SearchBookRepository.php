<?php

namespace App\Repository\Search;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class SearchBookRepository implements ISearchBookRepository
{
    /**
     * @param string $query
     * @return Collection
     */
    public function search(string $query) : Collection
    {
        $book = new Book();
        return $book->defaultSearch($query);
    }
}
