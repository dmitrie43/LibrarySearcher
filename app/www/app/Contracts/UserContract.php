<?php

namespace App\Contracts;

use App\Models\Dto\UserDto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserContract
{
    public function getList(array $filter = []): Collection|LengthAwarePaginator;

    public function create(array $data): UserDto;
}
