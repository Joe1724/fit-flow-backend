<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\Subscription;
use Exception;
use Illuminate\Support\Facades\DB;

class PaymentService
{
    public function processPayment($user, array $data)
    {
        return DB::transaction(function () use ($user, $data) {
            
            $subscription = Subscription::where('id', $data['subscription_id'])
                ->where('user_id', $user->id)
                ->firstOrFail();

            if ($subscription->status === 'active') {
                throw new Exception("This subscription is already active.");
            }

            $payment = Payment::create([
                'user_id' => $user->id,
                'subscription_id' => $subscription->id,
                'amount' => $data['amount'],
                'payment_method' => $data['payment_method'],
                'transaction_id' => $data['transaction_id'],
                'status' => 'completed',
            ]);

            $subscription->update([
                'status' => 'active',
                'start_date' => now(),
                'end_date' => now()->addDays(30)
            ]);

            return $payment;
        });
    }

    public function getUserPayments($user)
    {
        return Payment::where('user_id', $user->id)
            ->with('subscription.plan')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}