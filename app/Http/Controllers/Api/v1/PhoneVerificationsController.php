<?php

namespace App\Http\Controllers\Api\v1;

use App\Events\PhoneVerificationEvent;
use App\Http\Controllers\Controller;
use App\PhoneVerification;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PhoneVerificationsController extends Controller
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

        $result = PhoneVerification::where('phone', request()->phone)->first();

        if ($result != null && $result->status == 1) {

            if (!User::where('phone', request()->phone)->exists()) {

                $code = rand(1001, 9998);

                $result->update([
                    'code' => $code,
                    'status' => 0,
                    'created_at' => Carbon::now(),
                ]);

                //        <<< Event send verification code Sms  >>>
            event(new PhoneVerificationEvent($result));

                return response()->json([
                    'status' => 201,
                    'next' => 'code',
                    'message' => 'کد جدید به شماره موبایل شما ارسال شد.',
                    'phone' => $result->phone,
                ], 201);
            }
            return response()->json([
                'status' => 200,
                'message' => 'برای ورود کلمه عبور خود را وارد کنید.',
                'next' => 'password',
                'phone' => $result->phone
            ], 200);

        } else if ($result != null && $result->status == 0) {

            $code = rand(1001, 9998);

            $result->update([
                'code' => $code,
                'created_at' => Carbon::now(),
            ]);

            //        <<< Event send verification code Sms  >>>
            event(new PhoneVerificationEvent($result));

            return response()->json([
                'status' => 201,
                'next' => 'code',
                'message' => 'کد جدید به شماره موبایل شما ارسال شد.',
                'phone' => $result->phone,
            ], 201);
        }

        $code = rand(1001, 9998);

        $phone_verification = PhoneVerification::create([
            'phone' => request()->phone,
            'code' => $code,
        ]);


//        <<< Event send verification code Sms  >>>
        event(new PhoneVerificationEvent($phone_verification));


        return response()->json([
            'status' => 201,
            'next' => 'code',
            'message' => 'کد تایید به شماره موبایل شما ارسال شد.',
            'phone' => request()->phone,
        ],201);

    }

    public function check()
    {
        request()->validate([
            'code' => 'required|numeric'
        ]);

        $result = PhoneVerification::where('phone', request()->phone)->where('code', request()->code)->first();


        if ($result && gmdate($result->updated_at->diffInSeconds(Carbon::now())) >= 300) {

            return response()->json([
                'status' => 401,
                'time' => 'expire',
                'message' => 'کد وارد شده منقضی شده است لطفا بر روی ارسال مجدد کلیک کنید.',
                'phone' => request()->phone
            ], 401);

        } else if ($result) {

            $result->update([
                'status' => 1
            ]);

            return response()->json([
                'status' => 200,
                'next' => 'register',
                'message' => 'شماره موبایل شما با موفقیت تایید شد.',
                'phone' => $result->phone
            ], 200);
        }

        return response()->json([
            'status' => 401,
            'message' => 'کد وارد شده نامعتبر است',
            'phone' => request()->phone
        ], 401);
    }
}
