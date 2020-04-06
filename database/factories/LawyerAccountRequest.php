<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\LawyerAccountRequest;
use Faker\Generator as Faker;

$factory->define(LawyerAccountRequest::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'license_number' => $faker->numberBetween($min = 1234567, $max = 9876543),
        'national_no' => $faker->numberBetween($min = 1234567890, $max = 9876543211),
        'province' => $faker->state,
        'city' => $faker->city,
        'phone' => $faker->numberBetween($min = '09215420790', $max = '09215420799'),
        'lawyer_experience' => 12,
        'internet_consultation' => 3,
        'status' => 0
    ];
});
