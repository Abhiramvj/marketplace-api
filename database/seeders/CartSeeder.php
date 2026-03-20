<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        $customers = User::where('role', UserRole::CUSTOMER)->get();
        $products  = Product::all();

        if ($products->isEmpty()) {
            $this->command->warn('⚠️  No products found — skipping CartSeeder.');
            return;
        }

        // Give 3 out of 5 customers an active cart with 2-4 items
        $customersWithCarts = $customers->take(3);

        foreach ($customersWithCarts as $customer) {
            $cart = Cart::create(['user_id' => $customer->id]);

            // Pick 2–4 random unique products
            $cartProducts = $products->random(rand(2, 4));

            foreach ($cartProducts as $product) {
                // Quantity between 1 and 3, but never exceeding stock
                $maxQty  = min(3, $product->stock);
                $quantity = rand(1, max(1, $maxQty));

                CartItem::create([
                    'cart_id'    => $cart->id,
                    'product_id' => $product->id,
                    'quantity'   => $quantity,
                ]);
            }
        }

        $this->command->info('✅  Carts seeded — 3 customers have active carts');
    }
}