<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends ApiController
{
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $request->ensureIsNotRateLimited();

            if (! Auth::attempt($request->only(['email', 'password']))) {
                RateLimiter::hit($request->throttleKey());

                return response()->json([
                    'success' => false,
                    'message' => trans('auth.failed'),
                ], 401);
            }

            $user = User::query()->where('email', $request->input('email'))->firstOrFail();

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
