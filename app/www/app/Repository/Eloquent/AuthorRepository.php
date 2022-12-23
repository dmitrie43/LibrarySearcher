<?php

namespace App\Repository\Eloquent;

use App\Models\Author;
use App\Repository\IAuthorRepository;
use Illuminate\Support\Collection;

class AuthorRepository extends BaseRepository implements IAuthorRepository
{
    /**
     * BookRepository constructor.
     * @param Author $model
     */
    public function __construct(Author $model)
    {
        parent::__construct($model);
    }
}
