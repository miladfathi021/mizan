<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
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

        $user = User::create([
            'name' => request()->name,
            'phone' => request()->phone,
            'password' => Hash::make(request()->password)
        ]);

        return response()->json([
            'status' => 201,
            'user' => $user
        ]);
    }
}
