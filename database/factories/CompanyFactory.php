<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
      return [
        'name' => $faker->sentence(3),
        'url' => $faker->paragraph(4),
        'email' => $faker->paragraph(4)
  ];
});
