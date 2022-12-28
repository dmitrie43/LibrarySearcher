<?php

namespace App\Repository\Eloquent;

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
        return 'img/usericon.svg';
    }

    /**
     * @param \Illuminate\Http\UploadedFile $image
     */
    public function uploadAvatar(UploadedFile $image) : void
    {
        if ($image == null) return;
        $this->removeAvatar();
        $filename = Str::random(10) . '.' . $image->extension();
        $image->storeAs('/', $filename);
        $this->avatar = 'storage/'.$filename;
    }

    public function removeAvatar() : void
    {
        if (!empty($this->avatar)) {
            Storage::delete('uploads/' . $this->avatar);
        }
    }
}
