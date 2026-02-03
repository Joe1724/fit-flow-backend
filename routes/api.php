<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt; // <--- Added for manual decryption
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\GymClassController;
use App\Http\Controllers\AttendanceController; 
use App\Http\Controllers\SubscriptionController;
use App\Models\User; // <--- Added for the debug route

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

// ----------------------------------------------------------------------
// TEMP: Debug Route to show Decryption working
// Open http://127.0.0.1:8000/api/debug-encryption in your browser
// ----------------------------------------------------------------------
Route::get('/debug-encryption', function () {
    // 1. Get the first user (Admin)
    $user = User::first();

    if (!$user) {
        return response()->json(['message' => 'No users found. Run migration/seeder first.'], 404);
    }

    return response()->json([
        '1_explanation' => 'Laravel automatically decrypts fields listed in "casts" inside User.php',
        
        // This grabs the RAW encrypted string directly from the DB column (Gibberish)
        '2_raw_database_value' => $user->getAttributes()['email'], 
        
        // This accesses the property normally. Laravel decrypts it for you automatically! (Readable)
        '3_automatic_decryption' => $user->email,

        // This proves we can decrypt it manually using the Crypt facade
        '4_manual_decryption_proof' => Crypt::decryptString($user->getAttributes()['email']),
    ]);
});