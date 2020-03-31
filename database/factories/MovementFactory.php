<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Movement;
use Faker\Generator as Faker;

$factory->define(Movement::class, function (Faker $faker) {
    return [
        'type' => $faker->randomElement(array_keys(__('app.selects.movement.type'))),
        'date' => $faker->dateTimeBetween($startDate = '-1 year', $endDate = 'now'),
        'stock' => $faker->numberBetween(0,100),
        'warehouse_id' => function () {
            return factory(App\Warehouse::class)->create()->id;
        },/*
        'destination_id' => function () {
            return factory(App\Warehouse::class)->create()->id;
        },*/
    ];
});
