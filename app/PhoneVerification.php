<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneVerification extends Model
{
    protected $table = 'phone-verifications';
    protected $fillable = ['phone', 'code', 'status'];
}
