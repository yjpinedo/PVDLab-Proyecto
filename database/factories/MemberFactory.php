<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Member;
use Faker\Generator as Faker;

$factory->define(Member::class, function (Faker $faker) {
    $gender = $faker->randomElement(array_keys(__('app.selects.person.sex')));
    $ethnic_group =  $faker->randomElement(array_keys(__('app.selects.person.ethnic_group')));

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
        'ethnic_group' => $ethnic_group,
        'other_ethnic_group' => $ethnic_group === 'OTROS' ? $faker->jobTitle : null,
        'stratum' => $faker->randomElement(array_keys(__('app.selects.person.stratum'))),
        /*'project_id' => function () {
            return factory(App\Project::class)->create()->id;
        },*/
    ];
});
