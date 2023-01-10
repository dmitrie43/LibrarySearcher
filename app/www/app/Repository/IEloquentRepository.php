<?php

namespace App\Repository;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface IEloquentRepository
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * @param $id
     * @return Model|null
     */
    public function find($id): ?Model;

    public function save(): void;

    /**
     * @param $fields
     */
    public function fill($fields): void;
    /**
     * @return Collection
     */
    public function all(): Collection;

    public function paginate(int $int);
}
