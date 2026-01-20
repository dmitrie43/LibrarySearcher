<?php

namespace App\Services;

use App\Contracts\UserContract;
use App\Models\Dto\UserDto;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService extends BaseModelService implements UserContract
{
    public function getList(array $filter = []): Collection|LengthAwarePaginator
    {
        $builder = User::query();

        $this->options($builder, $filter);

        return isset($filter['paginate']) ? $builder->paginate($filter['paginate'])->withQueryString() : $builder->get();
    }

    public function create(array $data): UserDto
    {
        /** @var User $user */
        $user = User::query()->create($data);

        return new UserDto(
            id: $user->id,
            name: $user->name,
            email: $user->email,
            password: $user->password,
            role_id: $user->role_id,
            avatar: $user->avatar,
            remember_token: $user->getRememberToken(),
            created_at: $user->created_at,
            updated_at: $user->updated_at,
            deleted_at: $user->deleted_at,
        );
    }
}
