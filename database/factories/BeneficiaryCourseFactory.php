<?php

/** @var Factory $factory */

use App\BeneficiaryCourse;
use Illuminate\Database\Eloquent\Factory;
use Faker\Generator as Faker;

$factory->define(BeneficiaryCourse::class, function (Faker $faker) {
    return [
        'confirm' => $faker->boolean,
        'beneficiary_id' => function () {
            return factory(App\Beneficiary::class)->create()->id;
        },
        'course_id' => function () {
            return factory(App\Course::class)->create()->id;
        },
    ];
});
