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
    public string $avatar = '';

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

    public function getDefaultPathAvatar(): ?string
    {
        return public_path('img/usericon.svg');
    }

    public function getDefaultAvatar(): UploadedFile
    {
        $file_info = pathinfo($this->getDefaultPathAvatar());

        return new UploadedFile(
            $this->getDefaultPathAvatar(),
            $file_info['basename'],
            mime_content_type($this->getDefaultPathAvatar())
        );
    }

    public function uploadAvatar(UploadedFile $image): void
    {
        if ($image == null) {
            return;
        }
        $filename = Str::random(10).'.'.$image->extension();
        $image->storeAs('storage/', $filename);
        $this->avatar = 'storage/'.$filename;
    }

    public function removeAvatar(User $user): void
    {
        if (! empty($user->avatar)) {
            Storage::delete($user->avatar);
        }
    }

    public function remove(User $user): void
    {
        $this->removeAvatar($user);
        $user->delete();
    }

    /**
     * @return mixed
     */
    public function getByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }
}
