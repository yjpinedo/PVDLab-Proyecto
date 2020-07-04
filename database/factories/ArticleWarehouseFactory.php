<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ArticleWarehouse;
use Faker\Generator as Faker;

$factory->define(ArticleWarehouse::class, function (Faker $faker) {
    return [
        'stock' => $faker->numberBetween(0,100),
        'warehouse_id' => function () {
            return factory(App\Warehouse::class)->create()->id;
        },
        'article_id' => function () {
            return factory(App\Article::class)->create()->id;
        }
    ];
});
