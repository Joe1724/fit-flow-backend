<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\GymClass; 
use Exception;

class BookingService
{
    public function createBooking($user, int $gymClassId)
    {
        // ERROR 2 FIXED: variable naming is now consistent ($gymClass)
        $gymClass = GymClass::findOrFail($gymClassId);

        $existingBooking = Booking::where('user_id', $user->id)
            ->where('gym_class_id', $gymClassId)
            ->first();

        if ($existingBooking) {
            throw new Exception("You have already booked this class.");
        }

        $currentBookings = Booking::where('gym_class_id', $gymClassId)->count();

        if ($currentBookings >= $gymClass->capacity) {
            throw new Exception("Class is fully booked.");
        }

        return Booking::create([
            'user_id' => $user->id,
            'gym_class_id' => $gymClass->id,
            'status' => 'confirmed',
        ]);
    }
}