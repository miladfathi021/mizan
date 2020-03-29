<?php

namespace App\Http\Controllers\Api\v1\helpers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Laravel\Passport\HasApiTokens;

class ApiTokensController extends Controller
{
    use HasApiTokens;

    public function check()
    {
        return response()->json([
            'message' => 'Ok'
        ], 200);
    }
}
