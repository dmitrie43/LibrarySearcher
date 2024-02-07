<?php

namespace App\Repository\Search;

use App\Models\Author;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class SearchAuthorRepository implements ISearchAuthorRepository
{
    /**
     * @param string $query
     * @return Collection
     */
    public function search(string $query) : Collection
    {
        $author = new Author();
        return $author->defaultSearch($query);
    }
}
