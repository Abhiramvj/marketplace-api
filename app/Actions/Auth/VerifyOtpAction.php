<?php

namespace App\Actions\Auth;

use App\Models\OtpCode;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class VerifyOtpAction
{
    public function execute(string $phone, string $otp): array
    {
        $record = OtpCode::where('phone', $phone)
            ->latest()
            ->first();

        if (! $record) {
            throw ValidationException::withMessages([
                'otp' => ['OTP not found.'],
            ]);
        }

        if ($record->verified_at) {
            throw ValidationException::withMessages([
                'otp' => ['OTP already used.'],
            ]);
        }

        if ($record->expires_at->isPast()) {
            throw ValidationException::withMessages([
                'otp' => ['OTP expired.'],
            ]);
        }

        if (! Hash::check($otp, $record->otp)) {
            throw ValidationException::withMessages([
                'otp' => ['Invalid OTP.'],
            ]);
        }

        $record->update([
            'verified_at' => now(),
        ]);

        $user = User::firstOrCreate(
            ['phone_number' => $phone],
            [
                'name' => 'Customer',
            ]
        );

        $token = $user->createToken('customer')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }
}
