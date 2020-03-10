<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LawyerContract extends Model
{
    protected $fillable = ['name', 'license_number', 'national_no', 'province', 'city', 'phone', 'lawyer_experience', 'internet_consultation'];
}
