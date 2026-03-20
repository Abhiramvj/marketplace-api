<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Electronics',
            'Clothing & Fashion',
            'Home & Kitchen',
            'Books & Stationery',
            'Sports & Outdoors',
            'Beauty & Personal Care',
            'Toys & Games',
            'Food & Groceries',
            'Automotive',
            'Health & Wellness',
        ];

        foreach ($categories as $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }

        $this->command->info('✅  Categories seeded — ' . count($categories) . ' categories');
    }
}