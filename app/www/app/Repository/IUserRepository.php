<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Http\UploadedFile;

interface IUserRepository
{
    public function isAllowAdminPanel(User $user);

    public function getDefaultPathAvatar();

    public function getDefaultAvatar(): UploadedFile;

    public function uploadAvatar(UploadedFile $image);

    public function removeAvatar(User $user);
}
