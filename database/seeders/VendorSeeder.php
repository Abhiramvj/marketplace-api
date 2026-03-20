<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Enums\VendorStatus;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VendorSeeder extends Seeder
{
    public function run(): void
    {
        $stores = [
            [
                'store_name'  => 'TechNova Store',
                'description' => 'Your one-stop shop for cutting-edge electronics, gadgets, and accessories. We source the best tech products from leading brands worldwide.',
                'status'      => VendorStatus::APPROVED,
            ],
            [
                'store_name'  => 'Fashion Forward',
                'description' => 'Trendy and affordable clothing for men, women, and kids. We bring the latest runway styles straight to your wardrobe.',
                'status'      => VendorStatus::APPROVED,
            ],
            [
                'store_name'  => 'Home Essentials Hub',
                'description' => 'Everything you need to make your house a home. From kitchen tools to décor, we have it all at great prices.',
                'status'      => VendorStatus::APPROVED,
            ],
            [
                'store_name'  => 'ActiveLife Sports',
                'description' => 'Premium sports gear and outdoor equipment for athletes and adventure seekers. Fuel your passion for fitness.',
                'status'      => VendorStatus::APPROVED,
            ],
            [
                'store_name'  => 'Wellness World',
                'description' => 'Natural health supplements, beauty products, and personal care items. We believe in clean, effective wellness.',
                'status'      => VendorStatus::PENDING,
            ],
        ];

        $vendorUsers = User::where('role', UserRole::VENDOR)->get();

        foreach ($vendorUsers as $index => $user) {
            $store = $stores[$index];
            Vendor::create([
                'user_id'     => $user->id,
                'store_name'  => $store['store_name'],
                'store_slug'  => Str::slug($store['store_name']),
                'description' => $store['description'],
                'status'      => $store['status'],
            ]);
        }

        $this->command->info('✅  Vendors seeded — 4 approved, 1 pending');
    }
}