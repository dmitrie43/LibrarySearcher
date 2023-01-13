<?php

namespace App\Repository\Search;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class SearchBookRepository extends SearchRepository implements ISearchBookRepository
{
    /**
     * SearchBookRepository constructor.
     * @param Book $model
     */
    public function __construct(Book $model)
    {
        parent::__construct($model);
    }

    /**
     * @param string $query
     * @return Collection
     */
    public function search(string $query) : Collection
    {
        return $this->model->defaultSearch($query);
    }
}
