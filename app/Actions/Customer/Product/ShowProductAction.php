<?php

namespace App\Actions\Customer\Product;

use App\Models\Product;

class ShowProductAction
{
    public function execute(Product $product): Product
    {
        return $product->load(['vendor', 'category']);
    }
}