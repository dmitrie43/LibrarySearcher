<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Repository\IUserRepository;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->all();
        foreach ($users as &$user) {
            $user->access_admin_panel = $this->userRepository->isAllowAdminPanel($user);
        }
        return view('admin.users.index', compact('users'));
    }
}
