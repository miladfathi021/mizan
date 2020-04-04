<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lawyer extends Model
{
    protected $fillable = ['user_id', 'gender', 'license_number', 'national_no', 'province', 'city', 'lawyer_experience'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
