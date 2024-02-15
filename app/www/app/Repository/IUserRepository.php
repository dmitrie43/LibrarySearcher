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

    public function getByEmail(string $email);

    public function setFavoriteBook(User $user, int $book_id);

    public function isBookFavorite(User $user, int $book_id);
}
