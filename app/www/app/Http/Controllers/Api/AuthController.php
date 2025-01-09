<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\IUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', Rules\Password::defaults()],
            ]);

            if (! Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email / Password does not match with our record.',
                ], 401);
            }

            $user = $this->userRepository->getByEmail($request->email);

            return response()->json([
                'success' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken(env('API_TOKEN'))->plainTextToken,
            ], 200);

        } catch (\Throwable $throwable) {
            return response()->json([
                'success' => false,
                'message' => $throwable->getMessage(),
            ], 500);
        }
    }
}
