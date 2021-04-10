<?php

/** @var Factory $factory */

use App\Teacher;
use Illuminate\Database\Eloquent\Factory;
use Faker\Generator as Faker;

$factory->define(Teacher::class, function (Faker $faker) {
    $gender = $faker->randomElement(array_keys(__('app.selects.person.sex')));

    return [
        'document_type' => $faker->randomElement(array_keys(__('app.selects.person.document_type'))),
        'document' => $faker->unique()->randomNumber($nbDigits = 9),
        'expedition_place' => $faker->streetName,
        'name' => $faker->firstName($gender),
        'last_name' => $faker->lastName . ' ' . $faker->lastName,
        'birth_date' => $faker->dateTimeBetween($startDate = '-60 years', $endDate = '-18 years'),
        'place_of_birth' => $faker->streetName,
        'sex' => $gender,
        'address' => $faker->streetAddress,
        'neighborhood' => $faker->streetName,
        'phone' => '5' . random_int (7, 9) . $faker->unique()->randomNumber($nbDigits = 5),
        'cellphone' => '3' . random_int (0, 2) . random_int (0, 9) . $faker->unique()->randomNumber($nbDigits = 7),
        'email' => $faker->unique()->safeEmail,
        'title' => $faker->jobTitle,
        'title_type' => $faker->randomElement(array_keys(__('app.selects.teacher.title_type'))),
        'collage' => $faker->company,
        'year' => $faker->year($max = 'now'),
        'state' => $faker->randomElement(array_keys(__('app.selects.state'))),
    ];
});
