<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function store(StorePaymentRequest $request): JsonResponse
    {
        try {
            $payment = $this->paymentService->processPayment(
                $request->user(),
                $request->validated()
            );

            return response()->json([
                'message' => 'Payment successful! Subscription activated.',
                'data' => $payment
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function myPayments(Request $request): JsonResponse
    {
        $payments = $this->paymentService->getUserPayments($request->user());

        return response()->json([
            'data' => $payments
        ]);
    }
}