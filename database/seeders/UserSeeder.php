<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin ─────────────────────────────────────────────────────────────
        User::create([
            'name'     => 'Admin User',
            'email'    => 'admin@marketplace.com',
            'password' => Hash::make('password'),
            'role'     => UserRole::ADMIN,
        ]);

        // ── Vendors ───────────────────────────────────────────────────────────
        $vendors = [
            ['name' => 'Alice Vendor',   'email' => 'alice@marketplace.com'],
            ['name' => 'Bob Vendor',     'email' => 'bob@marketplace.com'],
            ['name' => 'Carol Vendor',   'email' => 'carol@marketplace.com'],
            ['name' => 'David Vendor',   'email' => 'david@marketplace.com'],
            ['name' => 'Eve Vendor',     'email' => 'eve@marketplace.com'],
        ];

        foreach ($vendors as $vendor) {
            User::create([
                'name'     => $vendor['name'],
                'email'    => $vendor['email'],
                'password' => Hash::make('password'),
                'role'     => UserRole::VENDOR,
            ]);
        }

        // ── Customers ─────────────────────────────────────────────────────────
        $customers = [
            ['name' => 'John Customer',  'email' => 'john@example.com'],
            ['name' => 'Jane Customer',  'email' => 'jane@example.com'],
            ['name' => 'Mike Customer',  'email' => 'mike@example.com'],
            ['name' => 'Sara Customer',  'email' => 'sara@example.com'],
            ['name' => 'Tom Customer',   'email' => 'tom@example.com'],
        ];

        foreach ($customers as $customer) {
            User::create([
                'name'     => $customer['name'],
                'email'    => $customer['email'],
                'password' => Hash::make('password'),
                'role'     => UserRole::CUSTOMER,
            ]);
        }

        $this->command->info('✅  Users seeded — 1 admin, 5 vendors, 5 customers');
    }
}