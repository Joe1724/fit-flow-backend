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

// ============================================
// V2 API Routes
// ============================================
Route::prefix('v2')->group(function () {
    
    // Public Routes
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // Protected Routes (All Authenticated Users)
    Route::middleware('auth:sanctum')->group(function () {
        
        // Authentication & Account Management
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', function (Request $request) {
            return response()->json([
                'data' => $request->user()->load('profile'),
                'role' => $request->user()->role
            ]);
        });
        Route::put('/user/profile', [AuthController::class, 'updateProfile']);
        Route::put('/user/password', [AuthController::class, 'updatePassword']);

        // Membership & Finance (Members)
        Route::get('/plans', [PlanController::class, 'index']);
        Route::get('/my-subscriptions', [SubscriptionController::class, 'mySubscriptions']);
        Route::post('/subscribe', [SubscriptionController::class, 'store']);
        Route::get('/my-payments', [PaymentController::class, 'myPayments']);
        Route::post('/payments', [PaymentController::class, 'store']);

        // Bookings & Attendance (Members)
        Route::get('/classes', [GymClassController::class, 'index']);
        Route::get('/my-bookings', [BookingController::class, 'myBookings']);
        Route::post('/bookings', [BookingController::class, 'store']);
        Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);
        Route::get('/my-attendance', [AttendanceController::class, 'myAttendance']);
        Route::post('/attendance/check-in', [AttendanceController::class, 'checkIn']);
        Route::post('/attendance/check-out', [AttendanceController::class, 'checkOut']);
    });

    // Admin Only Routes
    Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
        
        // Plan Management
        Route::post('/plans', [PlanController::class, 'store']);
        
        // Class Management
        Route::post('/classes', [GymClassController::class, 'store']);
    });
});