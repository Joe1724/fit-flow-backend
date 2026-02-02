<?php

namespace App\Services;

use App\Models\MembershipPlan;

class PlanService
{
    public function getAllActivePlan()
    {
        return MembershipPlan::where('is_active', true)->get();
    }

    public function createPlan(array $data)
    {
        return MembershipPlan::create([
            'name' => $data['name'],
            'price' => $data['price'],
            'duration_days' => $data['duration_days'],
            'can_access_classes' => $data['can_access_classes'] ?? false,
            'is_active' => true,
        ]);
    }
}