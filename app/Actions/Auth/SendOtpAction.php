<?php

namespace App\Actions\Auth;

use App\Models\OtpCode;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class SendOtpAction
{
    public function execute(string $phone): void
    {
        $otp = random_int(100000, 999999);

        OtpCode::where('phone', $phone)->delete();

        OtpCode::create([
            'phone' => $phone,
            'otp' => Hash::make($otp),
            'expires_at' => now()->addMinutes(5),
        ]);

        Log::info("OTP for {$phone}: {$otp}");
    }
}
