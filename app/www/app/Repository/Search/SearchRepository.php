<?php

namespace App\Repository\Search;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class SearchRepository implements ISearchRepository
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
