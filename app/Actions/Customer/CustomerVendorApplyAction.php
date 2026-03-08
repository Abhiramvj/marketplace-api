<?php

namespace App\Actions\Customer;
use Illuminate\Support\Str;
use App\Models\Vendor;

class CustomerVendorApplyAction
{
    public function execute(array $data, $user)
    {
        $slug = Str::slug($data['store_name']);

        $count = Vendor::where('store_slug', 'like', "{$slug}%")->count();

        $storeSlug = $count ? "{$slug}-{$count}" : $slug;

        $vendor  =  Vendor::create([
            'user_id' => $user->id,
            'store_name' => $data['store_name'],
            'store_slug' => $storeSlug,
            'description' => $data['description'] ?? null,
            'status' => 'pending'
        ]);

        return $vendor;
    }
}
