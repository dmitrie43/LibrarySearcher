<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Role;
use App\Models\User;
use App\Repository\IUserRepository;
use App\Services\FileUploader;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function __construct(
        private IUserRepository $userRepository
    )
    {
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = $this->userRepository->getAll();

        return view('admin.users.index', compact('users'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $roles = Role::all();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(StoreRequest $request)
    {
        $avatar = null;
        if ($request->hasFile('avatar')) {
            $avatar = FileUploader::uploadAvatar($request->file('avatar'));
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
            'avatar' => $avatar,
        ]);

        event(new Registered($user));

        return redirect()->route('admin_panel.users.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(UpdateRequest $request, User $user)
    {
        $avatar = $user->avatar;
        if ($request->hasFile('avatar')) {
            if (! empty($avatar)) {
                Storage::delete($avatar);
            }
            $avatar = FileUploader::uploadAvatar($request->file('avatar'));
        }

        $user->update(array_merge($request->validated(), [
            'avatar' => $avatar,
            'password' => Hash::make($request->input('password')),
        ]));

        return redirect()->route('admin_panel.users.index');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('admin_panel.users.index');
    }
}
