<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\User as UserResource;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {

        request()->validate([
            'phone' => 'required|exists:users,phone',
            'password' => 'required|min:6',
        ]);

        if (! auth()->attempt([
            'phone' => request()->phone,
            'password' => request()->password
        ])) {
            return response()->json([
                'status' => 403
            ]);
        }

//        Delete All Tokens
        auth()->user()->tokens()->delete();

//        Create a new token
        $token = auth()->user()->createToken('Api Token')->accessToken;

        return new UserResource(auth()->user(), $token);
    }
}
