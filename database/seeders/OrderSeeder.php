<?php

namespace Database\Seeders;

use App\Enums\OrderStatus;
use App\Enums\UserRole;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $customers = User::where('role', UserRole::CUSTOMER)->get();
        $products  = Product::with('vendor')->get();

        if ($products->isEmpty()) {
            $this->command->warn('⚠️  No products found — skipping OrderSeeder.');
            return;
        }

        $orderCount = 0;

        foreach ($customers as $customer) {
            // Each customer gets 2–4 orders
            $numOrders = rand(2, 4);

            for ($i = 0; $i < $numOrders; $i++) {
                // Rotate through order statuses so the frontend can display all states
                $statuses = [
                    OrderStatus::Delivered,
                    OrderStatus::Delivered,
                    OrderStatus::Shipped,
                    OrderStatus::Paid,
                    OrderStatus::Pending,
                ];
                $status = $statuses[$i % count($statuses)];

                // Pick 1–3 random products for this order
                $orderProducts = $products->random(rand(1, 3));

                // Calculate total
                $total = 0;
                $items = [];

                foreach ($orderProducts as $product) {
                    $quantity  = rand(1, 3);
                    $linePrice = round($product->price * $quantity, 2);
                    $total    += $linePrice;

                    $items[] = [
                        'product_id' => $product->id,
                        'vendor_id'  => $product->vendor_id,
                        'price'      => $product->price,
                        'quantity'   => $quantity,
                    ];
                }

                $order = Order::create([
                    'user_id'     => $customer->id,
                    'total_price' => round($total, 2),
                    'status'      => $status,
                    'created_at'  => now()->subDays(rand(1, 60)), // spread over last 2 months
                ]);

                foreach ($items as $item) {
                    OrderItem::create(array_merge($item, ['order_id' => $order->id]));
                }

                $orderCount++;
            }
        }

        $this->command->info("✅  Orders seeded — {$orderCount} orders across {$customers->count()} customers");
    }
}