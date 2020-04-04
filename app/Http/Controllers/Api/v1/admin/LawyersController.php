<?php

namespace App\Http\Controllers\Api\v1\admin;

use App\Http\Controllers\Controller;
use App\Lawyer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LawyersController extends Controller
{
    public function store()
    {

        request()->validate([
            'name' => 'required',
            'phone' => 'required',
            'license_number' => 'required',
            'national_no' => 'required',
            'province' => 'required',
            'city' => 'required',
            'lawyer_experience' => 'required'
        ]);

        $user = User::where('phone', request()->phone)->first();

        if (!$user) {
            $password = Str::random(7);

            $user = User::create([
                'name' => request()->name,
                'phone' => request()->phone,
                'password' => Hash::make($password)
            ]);

            // Send sms "wip"
        }

        $lawyer = $user->lawyer()->create([
            'license_number' => request()->license_number,
            'national_no' => request()->national_no,
            'province' => request()->province,
            'city' => request()->city,
            'lawyer_experience' => request()->lawyer_experience,
        ]);

        return response()->json([
            'user' => $user,
            'message' => 'حساب برای وکیل ایجاد شد.',
            'status' => 201,
        ], 201);

    }
}
