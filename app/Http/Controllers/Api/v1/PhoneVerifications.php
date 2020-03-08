<?php

namespace App\Http\Controllers\Api\v1;

use App\Events\PhoneVerificationEvent;
use App\Http\Controllers\Controller;
use App\PhoneVerification;
use Illuminate\Http\Request;

class PhoneVerifications extends Controller
{
    /**
     *
     * Creates a verification code and sends it to the user's phone
     *
     */
    public function store()
    {
        request()->validate([
            'phone' => 'required|numeric'
        ]);

        $code = rand(1234, 9998);

        $phone_verification = PhoneVerification::create([
            'phone' => request()->phone,
            'code' => $code,
        ]);

//        <<< Event send verification code Sms  >>>
        event(new PhoneVerificationEvent($phone_verification));


        return response()->json([
            'status' => 201,
            'phone' => request()->phone,
        ]);

    }

    public function check()
    {
        request()->validate([
            'code' => 'required|numeric|digits_between:4,4'
        ]);

        $result = PhoneVerification::where('phone', request()->phone)->where('code', request()->code)->first();

        if ($result) {

            $result->update([
                'status' => 1
            ]);

            return response()->json([
                'status' => 200,
                'phone' => $result->phone
            ]);
        }

        return response()->json([
            'status' => 404,
            'phone' => request()->phone
        ]);
    }
}
