<?php

/** @var Factory $factory */

use App\Course;
use App\Teacher;
use Illuminate\Database\Eloquent\Factory;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'code' => 'CUR' . ' - ' .$faker->numberBetween($min = 1, $max = 1000),
        'name' => $faker->jobTitle,
        'description' => $faker->text($maxNbChars = 200),
        'teacher_id' => function () {
            return factory(Teacher::class)->create()->id;
        },
    ];
});
