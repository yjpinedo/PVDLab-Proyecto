<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\BeneficiaryProject;
use Faker\Generator as Faker;

$factory->define(BeneficiaryProject::class, function (Faker $faker) {
    return [
        /*'beneficiary_id' => function () {
            return factory(App\Beneficiary::class)->create()->id;
        },
        'project_id' => function () {
            return factory(App\Project::class)->create()->id;
        },*/
    ];
});
