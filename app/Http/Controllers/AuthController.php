<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

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
}