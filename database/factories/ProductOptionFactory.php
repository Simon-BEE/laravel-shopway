<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Products\ProductOption;
use Faker\Generator as Faker;

$factory->define(ProductOption::class, function (Faker $faker) {
    return [
        'price' => mt_rand(1000, 10000),
        'weight' => mt_rand(100, 1000),
        'color_id' => mt_rand(1, 10),
        'material_id' => mt_rand(1, 6),
    ];
});
