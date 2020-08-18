<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Products\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->words(3, true),
        'slug' => $faker->slug(),
    ];
});
