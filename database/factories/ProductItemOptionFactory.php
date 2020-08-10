<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductItemOption;
use Faker\Generator as Faker;

$factory->define(ProductItemOption::class, function (Faker $faker) {
    return [
        'price' => mt_rand(1000, 10000),
        'weight' => mt_rand(100, 1000),
        'quantity' => mt_rand(10, 50),
    ];
});
