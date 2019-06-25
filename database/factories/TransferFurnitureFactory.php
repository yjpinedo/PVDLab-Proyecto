<?php

/** @var Factory $factory */

use App\Furniture;
use App\Transfer;
use App\FurnitureTransfer;
use Illuminate\Database\Eloquent\Factory;
use Faker\Generator as Faker;

$factory->define(FurnitureTransfer::class, function (Faker $faker) {
    return [
        'transfer_id' => function () {
            return factory(Transfer::class)->create()->id;
        },
        'furniture_id' => function () {
            return factory(Furniture::class)->create()->id;
        },
    ];
});
