<?php

namespace App\Actions\Customer\Product;

use App\Filters\ProductFilter;
use App\Models\Product;
use Illuminate\Http\Request;

class GetProductsAction
{
    public function execute(Request $request)
    {
        $filter = new ProductFilter($request);

        return $filter
            ->apply(Product::with(['vendor', 'category']))
            ->orderBy('created_at', 'desc')
            ->paginate($request->integer('per_page', 15));
    }
}