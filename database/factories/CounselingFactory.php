<?php

use Faker\Generator as Faker;

$factory->define(App\Counseling::class, function (Faker $faker) {
    return [
      'client_id'   => $faker->numberBetween(1,50),
      'description' => $faker->text(200),
      'date'        => $faker->dateTime('now', null)
    ];
});
