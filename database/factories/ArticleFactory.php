<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
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
        'warehouse_id' => function () {
            return factory(App\Warehouse::class)->create()->id;
        },
    ];
});
