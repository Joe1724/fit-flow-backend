<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlanRequest;
use App\Http\Controllers\Controller;
use App\Services\PlanService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class PlanController extends Controller
{
    // Fixed capitalization to match constructor
    protected $planService;

    public function __construct(PlanService $planService)
    {
        $this->planService = $planService;
    }

    public function index(): JsonResponse
    {
        $plans = $this->planService->getAllActivePlan();

        return response()->json([

            'data' => $plans 
        ]);
    }

    public function store(StorePlanRequest $request): JsonResponse
    {
        $plan = $this->planService->createPlan($request->validated());
        
        return response()->json([
            'message' => 'Plan created successfully',
            'data' => $plan
        ], 201);
    }
}