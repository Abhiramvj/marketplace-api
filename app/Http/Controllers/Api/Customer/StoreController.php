<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * GET /api/stores
     * Browse all approved vendor stores.
     */
    public function index(Request $request): JsonResponse
    {
        $stores = Vendor::approved()
            ->with(['products' => fn ($q) => $q->limit(6)])
            ->when($request->search, fn ($q) => $q->where('store_name', 'ilike', "%{$request->search}%"))
            ->orderBy('store_name')
            ->paginate($request->integer('per_page', 15));

        return response()->json([
            'success' => true,
            'message' => 'Stores retrieved successfully.',
            'data'    => $stores,
        ]);
    }

    /**
     * GET /api/stores/{slug}
     * View a single vendor store with paginated products.
     */
    public function show(Request $request, string $slug): JsonResponse
    {
        $store = Vendor::approved()
            ->where('store_slug', $slug)
            ->firstOrFail();

        $products = $store->products()
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->paginate($request->integer('per_page', 15));

        return response()->json([
            'success' => true,
            'message' => 'Store retrieved successfully.',
            'data'    => [
                'store'    => $store,
                'products' => $products,
            ],
        ]);
    }
}
