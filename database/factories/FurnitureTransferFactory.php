<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\FurnitureTransfer;
use Faker\Generator as Faker;

$factory->define(FurnitureTransfer::class, function (Faker $faker) {
    return [
        'furniture_id' => function () {
            return factory(App\Furniture::class)->create()->id;
        },
        'transfer_id' => function () {
            return factory(App\Transfer::class)->create()->id;
        },
    ];
});
