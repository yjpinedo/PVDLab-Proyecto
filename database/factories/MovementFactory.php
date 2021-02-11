<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Movement;
use Faker\Generator as Faker;

$factory->define(Movement::class, function (Faker $faker) {
    $type = $faker->randomElement(array_keys(__('app.selects.movement.type')));
    return [
        'type' => $type,
        'stock' => $faker->numberBetween(0,100),
        'origin_id' => $type === 'ENTRADA' ? null : \App\Warehouse::all()->random()->id,
        'destination_id' => $type === 'SALIDA' ? null : \App\Warehouse::all()->random()->id,
    ];
});
