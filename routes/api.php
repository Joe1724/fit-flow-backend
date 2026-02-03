<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\GymClassController;
use App\Http\Controllers\AttendanceController; 
use App\Http\Controllers\SubscriptionController;

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/plans', [PlanController::class, 'index']);
Route::get('/classes', [GymClassController::class, 'index']);

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    
    // Get User Profile
    Route::get('/user', function (Request $request) {
        return $request->user()->load('profile');
    });

    // Plans & Subscriptions
    Route::post('/plans', [PlanController::class, 'store']);
    Route::post('/subscribe', [SubscriptionController::class, 'store']);

    // Classes & Bookings
    Route::post('/classes', [GymClassController::class, 'store']);
    Route::post('/bookings', [BookingController::class, 'store']);

    // Attendance 
    Route::post('/attendance/check-in', [AttendanceController::class, 'checkIn']);
    Route::post('/attendance/check-out', [AttendanceController::class, 'checkOut']);

    // Payment
    Route::post('/payments', [PaymentController::class, 'store']);
});