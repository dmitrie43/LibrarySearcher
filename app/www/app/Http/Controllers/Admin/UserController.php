<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\UserContract;
use App\Events\UserCreated;
use App\Helpers\FileUploader;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(UserContract $userService): View
    {
        $users = $userService->getList();

        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        $roles = Role::all();

        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreRequest $request, UserContract $userService): RedirectResponse
    {
        $avatar = null;
        if ($request->hasFile('avatar')) {
            $avatar = FileUploader::upload($request->file('avatar'), FileUploader::AVATAR_PATH);
        }

        $userDto = $userService->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
            'avatar' => $avatar,
        ]);

        event(new UserCreated($userDto));

        return redirect()->route('admin_panel.users.index');
    }

    public function edit(User $user): View
    {
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(UpdateRequest $request, User $user): RedirectResponse
    {
        $avatar = $user->getOriginal('avatar');
        if ($request->hasFile('avatar')) {
            if (! empty($avatar)) {
                $user->removeImage('avatar');
            }
            $avatar = FileUploader::upload($request->file('avatar'), FileUploader::AVATAR_PATH);
        }

        $user->update(array_merge($request->validated(), [
            'avatar' => $avatar,
            'password' => Hash::make($request->input('password')),
        ]));

        return redirect()->route('admin_panel.users.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('admin_panel.users.index');
    }
}
