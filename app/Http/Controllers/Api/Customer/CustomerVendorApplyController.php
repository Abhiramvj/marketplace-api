<?php

namespace App\Http\Controllers\Api\Customer;

use App\Actions\Customer\CustomerVendorApplyAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\CustomervendorApplyRequest;

class CustomerVendorApplyController extends Controller
{
    public function apply(CustomervendorApplyRequest $request, CustomerVendorApplyAction $action)
    {
        $user = $request->user();

        if ($user->vendor) {
            return response()->json(['message' => 'You have already applied to be a vendor or are already a vendor.'], 400);
        }

        $vendor = $action->execute($request->validated(), $user);

        return response()->json(['message' => 'Vendor application submitted', 'data' => $vendor]);
    }
}
