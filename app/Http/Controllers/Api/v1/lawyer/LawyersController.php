<?php

namespace App\Http\Controllers\Api\v1\lawyer;

use App\Events\AccountInformationToLawyerEvent;
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
        $password = Str::random(7);

        if (!$user) {

            $user = User::create([
                'name' => request()->name,
                'phone' => request()->phone,
                'password' => Hash::make($password)
            ]);
        }

        $lawyer = $user->lawyer()->create([
            'gender' => request()->gender,
            'license_number' => request()->license_number,
            'national_no' => request()->national_no,
            'province' => request()->province,
            'city' => request()->city,
            'lawyer_experience' => request()->lawyer_experience,
        ]);

        event(new AccountInformationToLawyerEvent($user, $password));

        return response()->json([
            'user' => $user,
            'message' => 'حساب برای وکیل ایجاد شد.',
            'status' => 201,
        ], 201);

    }
}
