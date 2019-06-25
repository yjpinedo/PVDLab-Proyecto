<?php

/** @var Factory $factory */

use App\Beneficiary;
use Illuminate\Database\Eloquent\Factory;
use Faker\Generator as Faker;

$factory->define(Beneficiary::class, function (Faker $faker) {
    $gender = $faker->randomElement(array_keys(__('app.selects.person.sex')));
    return [
        'document_type' => $faker->randomElement(array_keys(__('app.selects.person.document_type'))),
        'document' => $faker->unique()->randomNumber($nbDigits = 9),
        'name' => $faker->firstName($gender),
        'last_name' => $faker->lastName . ' ' . $faker->lastName,
        'sex' => $gender,
        'birth_date' => $faker->dateTimeBetween($startDate = '-60 years', $endDate = '-18 years'),
        'place_of_birth' => $faker->streetName,
        'address' => $faker->streetAddress,
        'neighborhood' => $faker->streetName,
        'phone' => '5' . random_int (7, 9) . $faker->unique()->randomNumber($nbDigits = 5),
        'cellphone' => '3' . random_int (0, 2) . random_int (0, 9) . $faker->unique()->randomNumber($nbDigits = 7),
        'email' => $faker->unique()->safeEmail,
        'occupation' => $faker->streetName,
        'ethnic_group' => $faker->randomElement(array_keys(__('app.selects.person.ethnic_group'))),
        'stratum' => $faker->randomElement(array_keys(__('app.selects.person.stratum'))),
    ];
});
