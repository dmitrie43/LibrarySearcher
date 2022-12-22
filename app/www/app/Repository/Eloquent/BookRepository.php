<?php

namespace App\Repository\Eloquent;

use App\Models\Book;
use App\Repository\IBookRepository;
use Illuminate\Support\Collection;

class BookRepository extends BaseRepository implements IBookRepository
{
    /**
     * BookRepository constructor.
     * @param Book $model
     */
    public function __construct(Book $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }
}
