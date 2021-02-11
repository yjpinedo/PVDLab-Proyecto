<?php

/** @var Factory $factory */

use App\Article;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'code' => 'ART' . ' - ' .$faker->numberBetween($min = 1, $max = 1000),
        'name' => $faker->jobTitle,
        'brand' => $faker->jobTitle,
        'serial' => $faker->unique()->randomNumber($nbDigits = 9),
        'pattern' => $faker->jobTitle,
        'description' => $faker->text($maxNbChars = 200),
        /*'category_id' => function () {
            return factory(App\Category::class)->create()->id;
        },*/
    ];
});
