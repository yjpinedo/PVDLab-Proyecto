<?php

/** @var Factory $factory */

use App\Loan;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Loan::class, function (Faker $faker) {
    return [
        'refund' => \Carbon\Carbon::now()->addMonth(),
        'state' => $faker->randomElement(array_keys(__('app.selects.loans.state'))),
        'employee_id' => \App\Employee::all()->random()->id,
        'beneficiary_id' => \App\Beneficiary::all()->random()->id,
    ];
});
