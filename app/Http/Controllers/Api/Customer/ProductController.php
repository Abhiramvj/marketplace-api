<?php

namespace App\Http\Controllers\Api\Customer;

use App\Actions\Customer\Product\GetProductsAction;
use App\Actions\Customer\Product\SearchProductsAction;
use App\Actions\Customer\Product\ShowProductAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Customer\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * GET /api/products
     * Browse paginated product listing with optional filters.
     */
    public function index(Request $request, GetProductsAction $action): JsonResponse
    {
        $products = $action->execute($request);

        return response()->json([
            'success' => true,
            'message' => 'Products retrieved successfully.',
            'data' => ProductResource::collection($products),
        ]);
    }

    /**
     * GET /api/products/{slug}
     * View a single product by slug.
     */
    public function show(Product $product, ShowProductAction $action): JsonResponse
    {
        $product = $action->execute($product);

        return response()->json([
            'success' => true,
            'message' => 'Product retrieved successfully.',
            'data' => new ProductResource($product),
        ]);
    }

    public function search(Request $request, SearchProductsAction $action): JsonResponse
    {
        $products = $action->execute($request);

        return response()->json([
            'success' => true,
            'message' => 'Products retrieved successfully.',
            'data' => ProductResource::collection($products),
        ]);
    }
}
