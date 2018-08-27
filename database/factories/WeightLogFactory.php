<?php

use Faker\Generator as Faker;

$factory->define(App\WeightLog::class, function (Faker $faker) {
    $min = $faker->numberBetween(45, 48);
    $max = $faker->numberBetween(50, 55);

    return [
        'user_id' => function() {
            return factory(App\User::class)->create()->id;
        },
        'log_date' => $faker->unique()->date(),
        'min' => $min,
        'max' => $max,
        'variance' => $max - $min
    ];
});
