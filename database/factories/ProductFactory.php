<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->words(4, true),
        'slug' => $faker->slug,
        'description' => $faker->sentences(mt_rand(3, 6), true),
    ];
});
