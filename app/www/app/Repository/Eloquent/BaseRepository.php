<?php

namespace App\Repository\Eloquent;

use App\Repository\IEloquentRepository;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements IEloquentRepository
{
    protected Model $model;

    /**
     * BaseRepository constructor.
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
