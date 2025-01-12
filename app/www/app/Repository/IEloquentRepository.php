<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;

interface IEloquentRepository
{
    public function getAll(): Collection;
}
