<?php

namespace App\Actions\Customer;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class UpdateCartAction
{
    public function execute(User $user, int $productId, int $quantity): Cart
    {
        $cart = $user->cart;

        if (! $cart) {
            throw ValidationException::withMessages([
                'cart' => 'You have no active cart.',
            ]);
        }

        $cartItem = $cart->items()->where('product_id', $productId)->first();

        if (! $cartItem) {
            throw ValidationException::withMessages([
                'product_id' => 'This product is not in your cart.',
            ]);
        }

        // Validate stock
        $product = $cartItem->product;
        if (! $product->isInStock($quantity)) {
            throw ValidationException::withMessages([
                'quantity' => "Only {$product->stock} unit(s) available in stock.",
            ]);
        }

        $cartItem->update(['quantity' => $quantity]);

        return $cart->load('items.product.vendor', 'items.product.category');
    }
}
