<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PhoneVerification;
use Faker\Generator as Faker;

$factory->define(PhoneVerification::class, function (Faker $faker) {
    return [
        'phone' => '09215420796',
        'code' => $faker->numberBetween(1234, 9998),
        'status' => 0
    ];
});
