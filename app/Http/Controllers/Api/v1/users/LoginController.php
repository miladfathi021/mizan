<?php

namespace App\Http\Controllers\Api\v1\users;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\User as UserResource;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {

        $validate = request()->validate([
            'phone' => 'required',
            'password' => 'required|min:6',
        ]);

        if (! auth()->attempt($validate)) {
            return response()->json([
                'status' => 401,
                'message' => 'اطلاعات وارد شده صحیح نمی باشد'
            ], 401);
        }

//        Delete All Tokens
        auth()->user()->tokens()->delete();

//        Create a new token
        $token = auth()->user()->createToken('Api Token')->accessToken;

        return new UserResource(auth()->user(), $token);
    }
}
