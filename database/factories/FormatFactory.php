<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Format;
use Faker\Generator as Faker;

$factory->define(Format::class, function (Faker $faker) {
    return [
        'name' => $faker->jobTitle
    ];
});
