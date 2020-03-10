<?php

namespace App\Http\Controllers\Api\v1\lawyer;

use App\Http\Controllers\Controller;
use App\LawyerContract;
use Illuminate\Http\Request;

class LawyerContractsController extends Controller
{
    public function store()
    {
        $validate = request()->validate([
            'name' => 'required',
            'license_number' => 'required',
            'national_no' => 'required',
            'province' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'lawyer_experience' => 'required',
            'internet_consultation' => 'required',
        ]);

        LawyerContract::create($validate);

        return response()->json([
            'status' => 201,
            'message' => request()->name . ' عزیز درخواست شما با موفقیت ارسال شد, همکاران ما به زودی با شما تماس خواهند گرفت.'
        ]);
    }
}
