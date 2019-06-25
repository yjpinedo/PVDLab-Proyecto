<?php

/** @var Factory $factory */

use App\Furniture;
use Illuminate\Database\Eloquent\Factory;
use Faker\Generator as Faker;

$factory->define(Furniture::class, function (Faker $faker) {
    return [
        'code' => 'MUE' . ' - ' .$faker->numberBetween($min = 1, $max = 1000),
        'name' => $faker->jobTitle,
        'brand' => $faker->jobTitle,
        'serial' => $faker->unique()->randomNumber($nbDigits = 9),
        'pattern' => $faker->jobTitle,
        'description' => $faker->text($maxNbChars = 200),
        'category_id' => function () {
            return factory(App\Category::class)->create()->id;
        },
        'location_id' => function () {
            return factory(App\Location::class)->create()->id;
        },
    ];
});
