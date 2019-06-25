<?php

/** @var Factory $factory */

use App\BeneficiaryLesson;
use Illuminate\Database\Eloquent\Factory;

$factory->define(BeneficiaryLesson::class, function () {
    return [
        'beneficiary_id' => function () {
            return factory(App\Beneficiary::class)->create()->id;
        },
        'lesson_id' => function () {
            return factory(App\Lesson::class)->create()->id;
        },
    ];
});
