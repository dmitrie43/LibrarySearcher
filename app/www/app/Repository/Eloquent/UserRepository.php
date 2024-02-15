<?php

namespace App\Repository\Eloquent;

use App\Models\FavoriteBook;
use App\Models\Role;
use App\Models\User;
use App\Repository\IUserRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserRepository extends BaseRepository implements IUserRepository
{
    public string $avatar = '';

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

    /**
     * @return string|null
     */
    public function getDefaultPathAvatar() : ?string
    {
        return public_path('img/usericon.svg');
    }

    /**
     * @return UploadedFile
     */
    public function getDefaultAvatar() : UploadedFile
    {
        $file_info = pathinfo($this->getDefaultPathAvatar());
        return new UploadedFile(
            $this->getDefaultPathAvatar(),
            $file_info['basename'],
            mime_content_type($this->getDefaultPathAvatar())
        );
    }

    /**
     * @param \Illuminate\Http\UploadedFile $image
     */
    public function uploadAvatar(UploadedFile $image) : void
    {
        if ($image == null) return;
        $filename = Str::random(10) . '.' . $image->extension();
        $image->storeAs('storage/', $filename);
        $this->avatar = 'storage/'.$filename;
    }

    /**
     * @param User $user
     */
    public function removeAvatar(User $user) : void
    {
        if (!empty($user->avatar)) {
            Storage::delete($user->avatar);
        }
    }

    /**
     * @param User $user
     */
    public function remove(User $user) : void
    {
        $this->removeAvatar($user);
        $user->delete();
    }

    /**
     * @param string $email
     * @return mixed
     */
    public function getByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

    /**
     * @param User $user
     * @param int $book_id
     * @return bool Is favorite now or not
     */
    public function setFavoriteBook(User $user, int $book_id) : bool
    {
        $is_favorite = FavoriteBook::where('book_id', $book_id)->first();
        if ($is_favorite) {
            $is_favorite->delete();
            return false;
        } else {
            $user->favorite_book()->create([
                'book_id' => $book_id,
                'user_id' => $user->id,
            ]);
            return true;
        }
    }

    /**
     * @param User $user
     * @param int $book_id
     * @return bool
     */
    public function isBookFavorite(User $user, int $book_id)
    {
        return (bool) $user->favorite_book()->where('book_id', $book_id)->first();
    }
}
