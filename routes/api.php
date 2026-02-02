<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GymClassController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/plans', [PlanController::class, 'index']);
Route::get('/classes', [GymClassController::class, 'index']);

// Protected Routes (Single colon ':' is crucial here)
Route::middleware('auth:sanctum')->group(function () {
    
    // Get User Profile
    Route::get('/user', function (Request $request) {
        return $request->user()->load('profile');
    });

    // Create Plans (Admin)
    Route::post('/plans', [PlanController::class, 'store']);
    Route::post('/subscribe', [SubscriptionController::class, 'store']);
});

Route::middleware('auth:sanctum')->post('/classes', [GymClassController::class, 'store']);