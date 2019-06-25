<?php

/** @var Factory $factory */

use App\Category;
use Illuminate\Database\Eloquent\Factory;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'code' => 'CAT' . ' - ' .$faker->numberBetween($min = 1, $max = 1000),
        'name' => $faker->jobTitle,
        'description' => $faker->text($maxNbChars = 200),
    ];
});
