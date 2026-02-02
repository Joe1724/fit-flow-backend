<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClassRequest;
use App\Services\ClassService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class GymClassController extends Controller
{
    protected $classService;

    public function __construct(ClassService $classService)
    {
        $this->classService = $classService;
    }

    public function index(): JsonResponse
    {
        $classes = $this->classService->getUpcomingClasses();

        return response()->json([
            'data' => $classes
        ]);
    }

    public function store(StoreClassRequest $request): JsonResponse
    {
        $class = $this->classService->createClass($request->validated());

        return response()->json([
            'message' => 'Class scheduled successfully',
            'data' => $class
        ], 201);
    }
}
