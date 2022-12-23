<?php

namespace App\Repository\Eloquent;

use App\Models\Genre;
use App\Repository\IGenreRepository;
use Illuminate\Support\Collection;

class GenreRepository extends BaseRepository implements IGenreRepository
{
    /**
     * BookRepository constructor.
     * @param Genre $model
     */
    public function __construct(Genre $model)
    {
        parent::__construct($model);
    }
}
