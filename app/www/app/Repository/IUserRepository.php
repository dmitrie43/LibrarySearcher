<?php

namespace App\Repository;

use App\Models\User;

interface IUserRepository
{
    public function isAllowAdminPanel(User $user);

    public function getDefaultPathAvatar();
}
