<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriptionRequest;
use App\Services\SubscriptionService;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    protected $subcriptionService;

    public function __construct(SubscriptionService $subcriptionService)
    {
        $this->subcriptionService = $subcriptionService;
    }

    public function store(StoreSubscriptionRequest $request)
    {
        try {
            $subscription = $this->subcriptionService->createSubscription(
                $request->user(),
                $request->validated()['plan_id']
            );

            return response()->json([
                'message' => 'Subscription started successfully',
                'data' => $subscription
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
