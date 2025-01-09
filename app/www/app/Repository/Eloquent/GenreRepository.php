<?php

namespace App\Repository\Eloquent;

use App\Models\Genre;
use App\Repository\IGenreRepository;

class GenreRepository extends BaseRepository implements IGenreRepository
{
    /**
     * GenreRepository constructor.
     */
    public function __construct(Genre $model)
    {
        parent::__construct($model);
    }

    public function remove(Genre $genre): void
    {
        $genre->delete();
    }

    /**
     * @return mixed
     */
    public function getGenresWithBooks()
    {
        return $this->model->whereHas('books')->get();
    }
}
