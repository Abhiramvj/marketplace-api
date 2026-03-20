<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $vendors    = Vendor::all()->keyBy('store_name');
        $categories = Category::all()->keyBy('name');

        $products = [

            // ── TechNova Store ─────────────────────────────────────────────────
            [
                'vendor'      => 'TechNova Store',
                'category'    => 'Electronics',
                'name'        => 'Wireless Noise-Cancelling Headphones',
                'description' => 'Premium over-ear headphones with active noise cancellation, 30-hour battery life, and crystal-clear sound. Perfect for travel and remote work.',
                'price'       => 149.99,
                'stock'       => 85,
                'image'       => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=600',
            ],
            [
                'vendor'      => 'TechNova Store',
                'category'    => 'Electronics',
                'name'        => 'Mechanical Gaming Keyboard',
                'description' => 'RGB backlit mechanical keyboard with tactile blue switches. Anti-ghosting, programmable macros, and a durable aluminum frame for serious gamers.',
                'price'       => 89.99,
                'stock'       => 60,
                'image'       => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=600',
            ],
            [
                'vendor'      => 'TechNova Store',
                'category'    => 'Electronics',
                'name'        => '4K Ultra HD Smart Monitor 27"',
                'description' => '27-inch 4K IPS display with HDR400, 144Hz refresh rate, and USB-C connectivity. Ideal for creative professionals and gamers alike.',
                'price'       => 399.99,
                'stock'       => 30,
                'image'       => 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=600',
            ],
            [
                'vendor'      => 'TechNova Store',
                'category'    => 'Electronics',
                'name'        => 'Portable Bluetooth Speaker',
                'description' => 'Waterproof (IPX7) portable speaker with 360° surround sound, 20-hour battery, and built-in microphone. Take your music anywhere.',
                'price'       => 59.99,
                'stock'       => 120,
                'image'       => 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=600',
            ],
            [
                'vendor'      => 'TechNova Store',
                'category'    => 'Electronics',
                'name'        => 'USB-C Hub 7-in-1',
                'description' => 'Expand your laptop with 4K HDMI, 3× USB-A 3.0, SD card reader, and 100W PD charging. Slim, portable design fits in any bag.',
                'price'       => 34.99,
                'stock'       => 200,
                'image'       => 'https://images.unsplash.com/photo-1625948515291-69613efd103f?w=600',
            ],
            [
                'vendor'      => 'TechNova Store',
                'category'    => 'Electronics',
                'name'        => 'Smartwatch Pro Series 5',
                'description' => 'Advanced health tracking with ECG, SpO2, GPS, and 7-day battery life. Compatible with iOS and Android. Available in 3 stylish colors.',
                'price'       => 229.99,
                'stock'       => 50,
                'image'       => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600',
            ],

            // ── Fashion Forward ────────────────────────────────────────────────
            [
                'vendor'      => 'Fashion Forward',
                'category'    => 'Clothing & Fashion',
                'name'        => 'Classic Slim-Fit Chinos',
                'description' => 'Versatile slim-fit chinos made from premium stretch cotton. Available in khaki, navy, olive, and black. Machine washable and wrinkle-resistant.',
                'price'       => 49.99,
                'stock'       => 150,
                'image'       => 'https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?w=600',
            ],
            [
                'vendor'      => 'Fashion Forward',
                'category'    => 'Clothing & Fashion',
                'name'        => 'Women\'s Floral Wrap Dress',
                'description' => 'Elegant wrap dress with a vibrant floral print. Flattering adjustable tie waist, V-neckline, and midi length. Great for brunch, beach, or date night.',
                'price'       => 64.99,
                'stock'       => 90,
                'image'       => 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?w=600',
            ],
            [
                'vendor'      => 'Fashion Forward',
                'category'    => 'Clothing & Fashion',
                'name'        => 'Premium Leather Sneakers',
                'description' => 'Handcrafted leather sneakers with a cushioned memory foam insole. Minimalist design pairs well with both casual and semi-formal outfits.',
                'price'       => 119.99,
                'stock'       => 75,
                'image'       => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600',
            ],
            [
                'vendor'      => 'Fashion Forward',
                'category'    => 'Clothing & Fashion',
                'name'        => 'Men\'s Merino Wool Sweater',
                'description' => '100% merino wool crewneck sweater. Naturally temperature-regulating, soft against the skin, and odour-resistant. A wardrobe essential.',
                'price'       => 89.99,
                'stock'       => 60,
                'image'       => 'https://images.unsplash.com/photo-1620012253295-c15cc3e65df4?w=600',
            ],
            [
                'vendor'      => 'Fashion Forward',
                'category'    => 'Clothing & Fashion',
                'name'        => 'Oversized Canvas Tote Bag',
                'description' => 'Heavy-duty canvas tote with interior zip pocket and reinforced handles. Spacious enough for groceries, the gym, or a day out.',
                'price'       => 29.99,
                'stock'       => 200,
                'image'       => 'https://images.unsplash.com/photo-1591561954557-26941169b49e?w=600',
            ],

            // ── Home Essentials Hub ────────────────────────────────────────────
            [
                'vendor'      => 'Home Essentials Hub',
                'category'    => 'Home & Kitchen',
                'name'        => 'Stainless Steel Cookware Set (10-Piece)',
                'description' => 'Complete 10-piece cookware set with tri-ply stainless steel construction. Oven-safe to 500°F, dishwasher safe, and compatible with all stovetops including induction.',
                'price'       => 189.99,
                'stock'       => 40,
                'image'       => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=600',
            ],
            [
                'vendor'      => 'Home Essentials Hub',
                'category'    => 'Home & Kitchen',
                'name'        => 'Ceramic Pour-Over Coffee Set',
                'description' => 'Handcrafted ceramic pour-over dripper with matching server and two mugs. Brews a clean, flavourful cup every time. Microwave and dishwasher safe.',
                'price'       => 44.99,
                'stock'       => 80,
                'image'       => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=600',
            ],
            [
                'vendor'      => 'Home Essentials Hub',
                'category'    => 'Home & Kitchen',
                'name'        => 'Bamboo Cutting Board Set (3-Pack)',
                'description' => 'Set of 3 eco-friendly bamboo cutting boards in small, medium, and large. Naturally antimicrobial, gentle on knife edges, and easy to clean.',
                'price'       => 32.99,
                'stock'       => 130,
                'image'       => 'https://images.unsplash.com/photo-1585515320310-259814833e62?w=600',
            ],
            [
                'vendor'      => 'Home Essentials Hub',
                'category'    => 'Home & Kitchen',
                'name'        => 'Air Purifier HEPA H13',
                'description' => 'True HEPA H13 filter captures 99.97% of particles. Covers up to 500 sq ft, whisper-quiet at night mode, and has a smart air quality sensor.',
                'price'       => 129.99,
                'stock'       => 45,
                'image'       => 'https://images.unsplash.com/photo-1585771724684-38269d6639fd?w=600',
            ],
            [
                'vendor'      => 'Home Essentials Hub',
                'category'    => 'Home & Kitchen',
                'name'        => 'Linen Duvet Cover Set — King',
                'description' => 'Breathable 100% linen duvet cover with two pillowcases. Stonewashed for a soft, lived-in feel. Available in 6 muted tones to match any bedroom.',
                'price'       => 109.99,
                'stock'       => 55,
                'image'       => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600',
            ],

            // ── ActiveLife Sports ──────────────────────────────────────────────
            [
                'vendor'      => 'ActiveLife Sports',
                'category'    => 'Sports & Outdoors',
                'name'        => 'Adjustable Dumbbell Set (5–52.5 lbs)',
                'description' => 'Space-saving adjustable dumbbells that replace 15 sets of weights. Dial-select system changes weight in seconds. Includes storage tray.',
                'price'       => 299.99,
                'stock'       => 25,
                'image'       => 'https://images.unsplash.com/photo-1540497077202-7c8a3999166f?w=600',
            ],
            [
                'vendor'      => 'ActiveLife Sports',
                'category'    => 'Sports & Outdoors',
                'name'        => 'Yoga Mat — 6mm Non-Slip',
                'description' => 'Eco-friendly TPE yoga mat with alignment lines, non-slip texture on both sides, and a carrying strap. Available in 8 vibrant colours.',
                'price'       => 39.99,
                'stock'       => 180,
                'image'       => 'https://images.unsplash.com/photo-1601925260368-ae2f83cf8b7f?w=600',
            ],
            [
                'vendor'      => 'ActiveLife Sports',
                'category'    => 'Sports & Outdoors',
                'name'        => 'Hydration Running Vest',
                'description' => '10L trail running vest with two 500ml soft flasks included. Bounce-free fit, reflective strips, and multiple pockets for nutrition and gear.',
                'price'       => 84.99,
                'stock'       => 65,
                'image'       => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=600',
            ],
            [
                'vendor'      => 'ActiveLife Sports',
                'category'    => 'Sports & Outdoors',
                'name'        => 'Resistance Bands Set (5 Levels)',
                'description' => 'Set of 5 latex resistance bands from extra-light to extra-heavy. Ideal for stretching, rehabilitation, and strength training. Includes carry bag.',
                'price'       => 24.99,
                'stock'       => 250,
                'image'       => 'https://images.unsplash.com/photo-1598289431512-b97b0917affc?w=600',
            ],
            [
                'vendor'      => 'ActiveLife Sports',
                'category'    => 'Sports & Outdoors',
                'name'        => 'Camping Hammock — Ultralight',
                'description' => 'Ultralight nylon hammock (400 lb capacity) with tree straps and carabiners included. Sets up in under 2 minutes. Weighs only 400g.',
                'price'       => 54.99,
                'stock'       => 95,
                'image'       => 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=600',
            ],

            // ── Mixed: Books, Beauty, Health ───────────────────────────────────
            [
                'vendor'      => 'Home Essentials Hub',
                'category'    => 'Books & Stationery',
                'name'        => 'Dotted Hardcover Notebook A5',
                'description' => 'Premium dotted bullet journal with 240 pages of 120gsm acid-free paper. Lay-flat binding, ribbon bookmark, and elastic closure. Beloved by planners and artists.',
                'price'       => 18.99,
                'stock'       => 300,
                'image'       => 'https://images.unsplash.com/photo-1531346878377-a5be20888e57?w=600',
            ],
            [
                'vendor'      => 'Fashion Forward',
                'category'    => 'Beauty & Personal Care',
                'name'        => 'Vitamin C Brightening Serum',
                'description' => '15% stabilised Vitamin C serum with hyaluronic acid and niacinamide. Visibly brightens, evens skin tone, and reduces fine lines in 4 weeks.',
                'price'       => 36.99,
                'stock'       => 110,
                'image'       => 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?w=600',
            ],
            [
                'vendor'      => 'ActiveLife Sports',
                'category'    => 'Health & Wellness',
                'name'        => 'Whey Protein Powder — Chocolate (2kg)',
                'description' => 'Cold-filtered whey protein with 25g protein per serving, low fat, and no added sugar. Mixes easily with water or milk. Informed Sport certified.',
                'price'       => 54.99,
                'stock'       => 140,
                'image'       => 'https://images.unsplash.com/photo-1593095948071-474c5cc2989d?w=600',
            ],
            [
                'vendor'      => 'TechNova Store',
                'category'    => 'Toys & Games',
                'name'        => 'STEM Robot Building Kit',
                'description' => 'Award-winning STEM robotics kit for ages 10+. Build 5 different robots, learn basic coding with the free app, and participate in online challenges.',
                'price'       => 74.99,
                'stock'       => 70,
                'image'       => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=600',
            ],
        ];

        foreach ($products as $data) {
            $vendor   = $vendors->get($data['vendor']);
            $category = $categories->get($data['category']);

            if (! $vendor || ! $category) {
                $this->command->warn("⚠️  Skipping '{$data['name']}' — vendor or category not found.");
                continue;
            }

            Product::create([
                'vendor_id'   => $vendor->id,
                'category_id' => $category->id,
                'name'        => $data['name'],
                'slug'        => Str::slug($data['name']),
                'description' => $data['description'],
                'price'       => $data['price'],
                'stock'       => $data['stock'],
                'image'       => $data['image'],
            ]);
        }

        $this->command->info('✅  Products seeded — ' . count($products) . ' products across 4 vendors');
    }
}