<?php

namespace App\Actions\Customer\Product;

use App\Enums\ProductStatus;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchProductsAction
{
    public function execute(Request $request)
    {
        $search = trim($request->input('q', ''));

        return Product::query()
            ->where('status', ProductStatus::ACTIVE)
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'ILIKE', "%{$search}%")
                        ->orWhere('description', 'ILIKE', "%{$search}%")
                        ->orWhere('slug', 'ILIKE', "%{$search}%");
                });
            })
            ->latest()
            ->paginate($request->integer('per_page', 12));
    }
}
