<?php

/** @var Factory $factory */

use App\Lesson;
use Illuminate\Database\Eloquent\Factory;
use Faker\Generator as Faker;

$factory->define(Lesson::class, function (Faker $faker) {
    return [
        'date' => $faker->dateTimeBetween($startDate = '-1 year', $endDate = 'now'),
        'course_id' => function () {
            return factory(App\Course::class)->create()->id;
        },
    ];
});
