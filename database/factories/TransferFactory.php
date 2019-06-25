<?php

/** @var Factory $factory */

use App\Transfer;
use Illuminate\Database\Eloquent\Factory;
use Faker\Generator as Faker;

$factory->define(Transfer::class, function (Faker $faker) {
    return [
        'date' => $faker->dateTimeBetween($startDate = '-1 year', $endDate = 'now'),
        'type' => $faker->jobTitle,
        'origin_id' => $faker->jobTitle,
        'destination_id' => $faker->jobTitle,
        'beneficiary_id' => function () {
            return factory(App\Beneficiary::class)->create()->id;
        },
        'employee_id' => function () {
            return factory(App\Employee::class)->create()->id;
        },
        'project_id' => function () {
            return factory(App\Project::class)->create()->id;
        },
    ];
});
