<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Http\UploadedFile;

interface IUserRepository
{
    public function isAllowAdminPanel(User $user);

    public function getByEmail(string $email);
}
