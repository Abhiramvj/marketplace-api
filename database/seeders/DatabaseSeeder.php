<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Order matters — foreign key constraints require:
     *   Users → Categories → Vendors → Products → Carts → Orders
     */
    public function run(): void
    {
        $this->command->info('');
        $this->command->info('🌱  Seeding marketplace database...');
        $this->command->info('');

        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            VendorSeeder::class,
            ProductSeeder::class,
            CartSeeder::class,
            OrderSeeder::class,
        ]);

        $this->command->info('');
        $this->command->info('🎉  All seeders completed successfully!');
        $this->command->info('');
        $this->command->table(
            ['Role', 'Email', 'Password'],
            [
                ['Admin',    'admin@marketplace.com', 'password'],
                ['Vendor',   'alice@marketplace.com', 'password'],
                ['Vendor',   'bob@marketplace.com',   'password'],
                ['Vendor',   'carol@marketplace.com', 'password'],
                ['Vendor',   'david@marketplace.com', 'password'],
                ['Vendor',   'eve@marketplace.com',   'password'],
                ['Customer', 'john@example.com',      'password'],
                ['Customer', 'jane@example.com',      'password'],
                ['Customer', 'mike@example.com',      'password'],
                ['Customer', 'sara@example.com',      'password'],
                ['Customer', 'tom@example.com',       'password'],
            ]
        );
    }
}