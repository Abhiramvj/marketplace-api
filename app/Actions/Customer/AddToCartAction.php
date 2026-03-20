<?php

namespace App\Actions\Customer;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AddToCartAction
{
    public function execute(User $user, int $productId, int $quantity): Cart
    {
        $product = Product::findOrFail($productId);

        if (! $product->isInStock($quantity)) {
            throw ValidationException::withMessages([
                'quantity' => "Only {$product->stock} unit(s) available in stock.",
            ]);
        }

        $cart = $user->cart()->firstOrCreate(['user_id' => $user->id]);

        $existingItem = $cart->items()->where('product_id', $productId)->first();

        if ($existingItem) {
            $newQuantity = $existingItem->quantity + $quantity;

            if (! $product->isInStock($newQuantity)) {
                throw ValidationException::withMessages([
                    'quantity' => "Cannot add more items. Only {$product->stock} unit(s) available in stock.",
                ]);
            }

            $existingItem->update(['quantity' => $newQuantity]);
        } else {
            $cart->items()->create([
                'product_id' => $productId,
                'quantity'   => $quantity,
            ]);
        }

        return $cart->load('items.product.vendor', 'items.product.category');
    }
}
