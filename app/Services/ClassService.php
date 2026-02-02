<?php

namespace App\Services;

use App\Models\GymClass;
use Illuminate\Support\Facades\DB;

class ClassService
{
    public function getUpcomingClasses()
    {
        return GymClass::with('trainer')
            ->where('start_time', '>=', now())
            ->orderBy('start_time', 'asc')
            ->get();
    }

    public function createClass(array $data)
    {
        return GymClass::create([
            'name' => $data['name'],
            'trainer_id' => $data['trainer_id'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'capacity' => $data['capacity'],
            'status' => 'scheduled',
        ]);
    }
}