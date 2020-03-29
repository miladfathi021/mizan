<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function homepage()
    {
        return view('homepage.index');
    }

    public function phoneCall()
    {
        return view('phone-call.phoneCall');
    }
}
