<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Reference;
use Faker\Generator as Faker;

$factory->define(Reference::class, function (Faker $faker) {
    return [
        'name' => $faker->words(3, true),
        'price' => mt_rand(100, 1000) / 10.0,
        'weight' => mt_rand(1, 4) / 1.8,
        'quantity' => mt_rand(10, 50),
        'active' => $faker->boolean(),
    ];
});
