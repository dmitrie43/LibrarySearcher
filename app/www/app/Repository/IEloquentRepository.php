<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface IEloquentRepository
{
    public function create(array $attributes): Model;

    public function find($id): ?Model;

    public function save(): void;

    public function fill($fields): void;

    public function all(): Collection;

    public function paginate(int $int);
}
