<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(StoreUserRequest $request): JsonResponse
    {
        $result = $this->authService->registerUser($request->validated());

        return response()->json([
            'message' => 'User registered successfully',
            'data' => $result
        ], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $result = $this->authService->loginUser(
            $request->validated()['email'],
            $request->validated()['password']
        );

        return response()->json([
            'message' => 'Login successful',
            'data' => $result
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $result = $this->authService->logoutUser($request->user());

        return response()->json($result);
    }

    public function updateProfile(UpdateProfileRequest $request): JsonResponse
    {
        $user = $this->authService->updateProfile(
            $request->user(),
            $request->validated()
        );

        return response()->json([
            'message' => 'Profile updated successfully',
            'data' => $user
        ]);
    }

    public function updatePassword(UpdatePasswordRequest $request): JsonResponse
    {
        $result = $this->authService->updatePassword(
            $request->user(),
            $request->validated()['old_password'],
            $request->validated()['new_password']
        );

        return response()->json($result);
    }
}