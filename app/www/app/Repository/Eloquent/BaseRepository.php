<?php

namespace App\Repository\Eloquent;

use App\Repository\IEloquentRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function save(): void
    {
        $this->model->save();
    }

    public function fill($fields): void
    {
        $this->model->fill($fields);
    }

    /**
     * @return mixed
     */
    public function paginate(int $int)
    {
        return $this->model->paginate($int);
    }
}
