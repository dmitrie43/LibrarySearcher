<?php

namespace App\Repository\Eloquent;

use App\Models\Role;
use App\Models\User;
use App\Repository\IUserRepository;
use Illuminate\Support\Collection;

class UserRepository extends BaseRepository implements IUserRepository
{
    /**
     * UserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function isAllowAdminPanel(User $user) : bool
    {
        return in_array($user->role_id, Role::getAllowAdminPanelRolesId());
    }
}
