<?php

/** @var Factory $factory */

use App\Position;
use Illuminate\Database\Eloquent\Factory;
use Faker\Generator as Faker;

$factory->define(Position::class, function (Faker $faker) {
    return [
        'code' => 'CAR' . ' - ' . $faker->numberBetween($min = 1, $max = 1000),
        'name' => $faker->jobTitle,
        'description' => $faker->text($maxNbChars = 200),
    ];
});
