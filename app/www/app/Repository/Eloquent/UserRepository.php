<?php

namespace App\Repository\Eloquent;

use App\Models\Role;
use App\Models\User;
use App\Repository\IUserRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserRepository extends BaseRepository implements IUserRepository
{
    /**
     * UserRepository constructor.
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function isAllowAdminPanel(User $user): bool
    {
        return in_array($user->role_id, Role::getAllowAdminPanelRolesId());
    }

    /**
     * @param string $email
     * @return array|null
     */
    public function getByEmail(string $email): ?array
    {
        return User::query()->where('email', $email)->first();
    }
}
