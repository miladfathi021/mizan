<?php

namespace App\Http\Controllers\Api\v1\users;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\User as UserResource;
use App\PhoneVerification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store()
    {
        request()->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|unique:users,phone',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $phone_verification = PhoneVerification::where('phone', request()->phone)->first();

        if ($phone_verification == null || $phone_verification->status == 0) {
            return response()->json([
                'message' => 'شما شماره موبایل خودتان را هنوز تایید نکرده اید.',
                'status' => 401
            ], 401);
        }

        $user = User::create([
            'name' => request()->name,
            'phone' => request()->phone,
            'password' => Hash::make(request()->password)
        ]);

        $user = User::where('phone', $user->phone)->first();

        $user->tokens()->delete();

        $token = $user->createToken('Api Token')->accessToken;

        return response()->json([
            'status' => 201,
            'user' => new UserResource($user, $token),
        ], 201);
    }
}
