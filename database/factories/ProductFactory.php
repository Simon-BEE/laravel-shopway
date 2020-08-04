<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->words(3, true),
        'slug' => $faker->slug,
        'description' => $faker->sentences(mt_rand(3, 6), true),
        'price' => mt_rand(1000, 10000),
        'weight' => mt_rand(100, 1000),
        'quantity' => mt_rand(10, 50),
        'active' => $faker->boolean(),
    ];
});
