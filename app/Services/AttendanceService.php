<?php

namespace App\Services;

use App\Models\AttendanceLog;
use Exception;

class AttendanceService
{
    public function checkIn($user, $method)
    {
        $activeSession = AttendanceLog::where('user_id', $user->id)
            ->whereNull('check_out')
            ->first();
        
        if ($activeSession){
            throw new Exception("User is already checked in since" . $activeSession->check_in);
        }

        return AttendanceLog::create([
            'user_id' => $user->id,
            'check_in' => now(),
            'method' => $method,
        ]);
    }

    public function checkOut($user)
    {
        $activeSession = AttendanceLog::where('user_id', $user->id)
            ->whereNull('check_out')
            ->latest()
            ->first();
        
        if (!$activeSession) {
            throw new Exception("No active check-in found for this user.");
        }

        $activeSession->update([
            'check_out' => now(),
        ]);

        return $activeSession;
    }

    public function getUserAttendance($user)
    {
        return AttendanceLog::where('user_id', $user->id)
            ->orderBy('check_in', 'desc')
            ->get();
    }
}