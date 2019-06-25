<?php

/** @var Factory $factory */

use App\Location;
use Illuminate\Database\Eloquent\Factory;
use Faker\Generator as Faker;

$factory->define(Location::class, function (Faker $faker) {
    return [
        'code' => 'LOC' . ' - ' .$faker->numberBetween($min = 1, $max = 1000),
        'name' => $faker->jobTitle,
        'description' => $faker->text($maxNbChars = 200),
    ];
});
