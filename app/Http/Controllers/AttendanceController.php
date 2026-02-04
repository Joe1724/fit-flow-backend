<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendanceRequest;
use App\Services\AttendanceService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class AttendanceController extends Controller
{
    protected $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function checkIn(StoreAttendanceRequest $request): JsonResponse
    {
        try{
            $log = $this->attendanceService->checkIn($request->user(), $request->method);

            return response()->json([
                'message' => 'Welcome to Fitflow',
                'data' => $log
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function checkOut(Request $request): JsonResponse
    {
        try{
            $log = $this->attendanceService->checkOut($request->user());
            
            return response()->json([
                'message' => 'Goodbye! See you next time.',
                'data' => $log
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e-> getMessage()], 400);
        }
    }

    public function myAttendance(Request $request): JsonResponse
    {
        $attendance = $this->attendanceService->getUserAttendance($request->user());

        return response()->json([
            'data' => $attendance
        ]);
    }
}
