<?php

namespace App\Http\Controllers\Api\Customer;

use App\Actions\Customer\CheckoutAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * POST /api/customer/checkout
     * Convert cart into an order.
     */
    public function store(Request $request, CheckoutAction $action): JsonResponse
    {
        $order = $action->execute($request->user());

        return response()->json([
            'success' => true,
            'message' => 'Order placed successfully.',
            'data'    => $order,
        ], 201);
    }
}
