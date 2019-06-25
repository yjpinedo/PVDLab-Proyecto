<?php

/** @var Factory $factory */

use App\BeneficiaryProject;
use Illuminate\Database\Eloquent\Factory;

$factory->define(BeneficiaryProject::class, function () {
    return [
        'project_id' => function () {
            return factory(App\Project::class)->create()->id;
        },
        'beneficiary_id' => function () {
            return factory(App\Beneficiary::class)->create()->id;
        },
    ];
});
