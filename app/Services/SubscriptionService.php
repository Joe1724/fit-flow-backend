<?php

namespace App\Services;

use Exception;
use Carbon\Carbon;
use App\Models\Subscription;
use App\Models\MembershipPlan;

class SubscriptionService
{
    public function createSubscription($user, int $planId)
    {
        $plan = MembershipPlan::findOrFail($planId);
        
        $existing = Subscription::where('user_id', $user->id)
        ->where('status', 'active')
        ->first();

        if ($existing) 
        {
            throw new Exception("User already has an active subscription");
        }

        $startDate = Carbon::now();
        $endDate = $startDate->copy()->addDays($plan->duration_days);

        return Subscription::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => 'active'
        ]);

    }

    public function getUserSubscriptions($user)
    {
        return Subscription::where('user_id', $user->id)
            ->with('plan')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}