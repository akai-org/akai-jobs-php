<?php

use Faker\Generator as Faker;

$factory->define(App\JobOffer::class, function (Faker $faker) {

    return [
        'name'          => $faker->name,
        'description'   => $faker->text,
        'salary'        => $faker->randomFloat(2),
        'start_date'    => $faker->date(),
        'end_date'      => $faker->date(),
        'area_id'       => $faker->randomNumber(),
        'position_id'   => $faker->randomNumber(),
        'degree_id'     => $faker->randomNumber(),
        'address_id'    => $faker->randomNumber(),
        'created_at'    => $faker->dateTimeBetween('-6 months', 'now'),
        'updated_at'    => $faker->dateTimeBetween('-3 months', 'now')
    ];
});
