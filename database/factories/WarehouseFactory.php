<?php

/** @var Factory $factory */

use App\Warehouse;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Warehouse::class, function (Faker $faker) {
    return [
        'code' => 'ALM' . ' - ' .$faker->numberBetween($min = 1, $max = 1000),
        'name' => $faker->jobTitle,
        'description' => $faker->text($maxNbChars = 200),
    ];
});
