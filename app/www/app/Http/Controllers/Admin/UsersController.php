<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Repository\IUserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UsersController extends Controller
{
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = $this->userRepository->all();

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
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            'avatar' => ['image'],
        ]);

        if ($request->hasFile('avatar')) {
            $this->userRepository->uploadAvatar($request->file('avatar'));
        } else {
            $this->userRepository->uploadAvatar($this->userRepository->getDefaultAvatar());
        }

        $user = $this->userRepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
            'avatar' => $this->userRepository->avatar,
        ]);

        event(new Registered($user));

        return redirect()->route('admin_panel.users.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $id)
    {
        $user = $this->userRepository->find($id);
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => ['string', 'max:255', 'nullable'],
            'email' => ['string', 'email', 'max:255', Rule::unique('users')->ignore($id), 'nullable'],
            'password' => [Rules\Password::defaults(), 'nullable'],
            'avatar' => ['image', 'nullable'],
        ]);

        DB::transaction(function () use ($id, $request) {
            $user = $this->userRepository->find($id);
            foreach ($request->all() as $key => $item) {
                if (($request->filled($key) || $request->hasFile($key)) && isset($user->$key)) {
                    switch ($key) {
                        case 'avatar':
                            if ($request->hasFile($key)) {
                                $this->userRepository->removeAvatar($user);
                                $this->userRepository->uploadAvatar($request->file($key));
                                $user->$key = $this->userRepository->$key;
                            }
                            break;
                        case 'password':
                            $user->$key = Hash::make($item);
                            break;
                        default:
                            $user->$key = $item;
                            break;
                    }
                }
            }
            $user->save();
        });

        return redirect()->route('admin_panel.users.index');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $user = $this->userRepository->find($id);
        $this->userRepository->remove($user);

        return redirect()->route('admin_panel.users.index');
    }
}
