<?php

namespace App\Repository\Eloquent;

use App\Models\Author;
use App\Repository\IAuthorRepository;

class AuthorRepository extends BaseRepository implements IAuthorRepository
{
    public function __construct(Author $model)
    {
        parent::__construct($model);
    }
}
