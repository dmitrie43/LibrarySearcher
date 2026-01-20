<?php

namespace App\Modules\User;

use App\Contracts\UserContract;
use App\Models\Dto\UserDto;
use App\Modules\BaseModule;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserModule extends BaseModule implements UserContract
{
    public function getList(array $filter = []): Collection|LengthAwarePaginator
    {
        return new Collection();
    }

    public function create(array $data): UserDto
    {
        $this->brokerService->sendUser(serialize($data));
    }
}
