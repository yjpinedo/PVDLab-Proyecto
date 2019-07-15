<?php

/** @var Factory $factory */

use App\Beneficiary;
use App\Employee;
use App\Project;
use Illuminate\Database\Eloquent\Factory;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    $type = $faker->randomElement(array_keys(__('app.selects.project.type')));
    $origin = $faker->randomElement(array_keys(__('app.selects.project.origin')));
    $financing = $faker->randomElement(array_keys(__('app.selects.project.financing')));

    return [
        'code' => 'PRO' . ' - ' .$faker->numberBetween($min = 1, $max = 1000),
        'name' => $faker->jobTitle,
        'date' => $faker->dateTimeBetween($startDate = '-1 year', $endDate = 'now'),
        'start' => $faker->dateTimeBetween($startDate = '-1 year', $endDate = 'now'),
        'type' => $type,
        'other_type' => $type === 'OTRO' ? $faker->jobTitle : null,
        'description' => $faker->text($maxNbChars = 200),
        'origin' => $origin,
        'other_origin' => $origin === 'OTRO' ? $faker->jobTitle : null,
        'state' => $faker->randomElement(array_keys(__('app.selects.project.state'))),
        'financing' => $financing,
        'financial_entity' => $financing === 'SI' ? $faker->jobTitle : null,
        'financing_description' => $faker->text($maxNbChars = 200),
        'observations' => $faker->text($maxNbChars = 200),
        'concept' => $faker->randomElement(array_keys(__('app.selects.project.concept'))),
        'beneficiary_id' => function () {
            return factory(Beneficiary::class)->create()->id;
        },
        'employee_id' => function () {
            return factory(Employee::class)->create()->id;
        },
        'reviewed_at' => $faker->dateTimeBetween($startDate = '-1 year', $endDate = 'now'),
    ];
});
