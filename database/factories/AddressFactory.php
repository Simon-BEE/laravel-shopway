<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    $pro = $faker->boolean(40);

    return [
        'name' => $faker->words(3, true),
        'lastname' => $pro ? null : $faker->lastName,
        'firstname' => $pro ? null : $faker->firstName,
        'company' => $pro ? $faker->company : null,
        'professionnal' => $pro,
        'address' => $faker->streetAddress,
        'info_address' => $faker->boolean() ? $faker->secondaryAddress : null,
        'zipcode' => $faker->numberBetween(10000, 90000),
        'city' => $faker->city,
        'country_id' => mt_rand(1, 4),
        'phone' => $faker->numberBetween(1000000000, 9000000000),
    ];
});
