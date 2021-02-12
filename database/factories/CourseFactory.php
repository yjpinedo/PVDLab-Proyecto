<?php

/** @var Factory $factory */

use App\Course;
use App\Teacher;
use Illuminate\Database\Eloquent\Factory;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    static $id = 0;
    return [
        'code' => 'CUR' . ' - ' .$faker->numberBetween($min = 1, $max = 1000),
        'name' => $faker->jobTitle,
        'description' => $faker->text($maxNbChars = 200),
        'slug' => "/beneficiary/courses_lists/" . $id++ . "/application_course",
        'state' => $faker->randomElement(array_keys(__('app.selects.course.state'))),
    ];
});
