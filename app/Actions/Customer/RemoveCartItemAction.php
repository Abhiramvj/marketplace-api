<?php

namespace App\Actions\Customer;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class RemoveCartItemAction
{
    public function execute(User $user, int $productId): Cart
    {
        $cart = $user->cart;

        if (! $cart) {
            throw ValidationException::withMessages([
                'cart' => 'You have no active cart.',
            ]);
        }

        $deleted = $cart->items()->where('product_id', $productId)->delete();

        if (! $deleted) {
            throw ValidationException::withMessages([
                'product_id' => 'This product is not in your cart.',
            ]);
        }

        return $cart->load('items.product.vendor', 'items.product.category');
    }
}
