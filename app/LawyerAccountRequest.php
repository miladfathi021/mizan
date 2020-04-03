<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LawyerAccountRequest extends Model
{
    protected $table = 'lawyer_account_request';
    protected $fillable = ['name', 'license_number', 'national_no', 'province', 'city', 'phone', 'lawyer_experience', 'internet_consultation'];
}
