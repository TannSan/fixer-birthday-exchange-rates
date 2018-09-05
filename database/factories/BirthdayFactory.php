<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\BirthdayExchangeRate::class, function (Faker $faker) {
    return [
        /* Using dateTimeBetween even though we just want the date but it's ok since the time is stripped when inserting */
        'birthday' => $faker->dateTimeBetween($startDate = '-1 years'),
        'search_count' => $faker->numberBetween(1, 3),
        'exchange_rate' => $faker->randomFloat(6, 0, 999)
    ];
});
