<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OtpService
{
    public function generateOTP()
    {
        return strtoupper(Str::random(6));
    }

    public function hashOTP($otp)
    {
        return Hash::make($otp);
    }
}
