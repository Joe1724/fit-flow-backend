<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }
    public function store(StoreBookingRequest $request): JsonResponse
    {
        try{
            $booking = $this->bookingService->createBooking(
                $request->user(),
                $request->validated()['gym_class_id']
            );

            return response()->json([
                'message' => 'Class booked successfully',
                'data' => $booking
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }


}
