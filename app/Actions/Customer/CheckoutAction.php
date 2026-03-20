<?php

namespace App\Actions\Customer;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CheckoutAction
{
    public function execute(User $user): Order
    {
        $cart = $user->cart()->with('items.product')->first();

        if (! $cart || $cart->items->isEmpty()) {
            throw ValidationException::withMessages([
                'cart' => 'Your cart is empty.',
            ]);
        }

        // Validate stock for all items before proceeding
        foreach ($cart->items as $item) {
            if (! $item->product->isInStock($item->quantity)) {
                throw ValidationException::withMessages([
                    'stock' => "Product '{$item->product->name}' only has {$item->product->stock} unit(s) left.",
                ]);
            }
        }

        return DB::transaction(function () use ($cart, $user) {
            // Calculate total
            $total = $cart->items->sum(
                fn ($item) => $item->product->price * $item->quantity
            );

            // Create the order
            $order = Order::create([
                'user_id'     => $user->id,
                'total_price' => $total,
                'status'      => OrderStatus::Pending->value,
            ]);

            // Create order items and decrement stock
            foreach ($cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'vendor_id'  => $item->product->vendor_id,
                    'price'      => $item->product->price,
                    'quantity'   => $item->quantity,
                ]);

                // Decrement stock
                $item->product->decrement('stock', $item->quantity);
            }

            // Clear the cart
            $cart->items()->delete();

            return $order->load('items.product', 'items.vendor');
        });
    }
}
