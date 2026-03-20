<?php

namespace App\Http\Controllers\Api\Customer;

use App\Actions\Customer\AddToCartAction;
use App\Actions\Customer\RemoveCartItemAction;
use App\Actions\Customer\UpdateCartAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\AddToCartRequest;
use App\Http\Requests\Customer\RemoveCartItemRequest;
use App\Http\Requests\Customer\UpdateCartRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * GET /api/customer/cart
     * View the authenticated customer's cart.
     */
    public function index(Request $request): JsonResponse
    {
        $cart = $request->user()
            ->cart()
            ->with('items.product.vendor', 'items.product.category')
            ->first();

        return response()->json([
            'success' => true,
            'message' => 'Cart retrieved successfully.',
            'data'    => $cart ?? ['items' => [], 'total' => 0],
        ]);
    }

    /**
     * POST /api/customer/cart/add
     * Add a product to the cart.
     */
    public function store(AddToCartRequest $request, AddToCartAction $action): JsonResponse
    {
        $cart = $action->execute(
            $request->user(),
            $request->integer('product_id'),
            $request->integer('quantity')
        );

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart.',
            'data'    => $cart,
        ], 201);
    }

    /**
     * PUT /api/customer/cart/update
     * Update the quantity of a cart item.
     */
    public function update(UpdateCartRequest $request, UpdateCartAction $action): JsonResponse
    {
        $cart = $action->execute(
            $request->user(),
            $request->integer('product_id'),
            $request->integer('quantity')
        );

        return response()->json([
            'success' => true,
            'message' => 'Cart updated.',
            'data'    => $cart,
        ]);
    }

    /**
     * DELETE /api/customer/cart/remove
     * Remove an item from the cart.
     */
    public function destroy(RemoveCartItemRequest $request, RemoveCartItemAction $action): JsonResponse
    {
        $cart = $action->execute(
            $request->user(),
            $request->integer('product_id')
        );

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart.',
            'data'    => $cart,
        ]);
    }
}
