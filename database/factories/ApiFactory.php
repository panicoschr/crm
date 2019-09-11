<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Api;
use Faker\Generator as Faker;

$factory->define(Api::class, function (Faker $faker) {
    return [
        'id' => 1,
    ];
});
