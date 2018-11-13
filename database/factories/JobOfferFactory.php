<?php

use Faker\Generator as Faker;

$factory->define(App\JobOffer::class, function (Faker $faker) {

    return [
        'name'          => $faker->name,
        'description'   => $faker->text(50),
        'salary'        => $faker->numberBetween(0,100),
        'start_date'    => $faker->date(),
        'end_date'      => $faker->date(),
        'area_id'       => $faker->numberBetween(0,100),
        'position_id'   => $faker->numberBetween(0,100),
        'degree_id'     => $faker->numberBetween(0,100),
        'address_id'    => $faker->numberBetween(0,100),
        'created_at'    => $faker->dateTimeBetween('-6 months', 'now'),
        'updated_at'    => $faker->dateTimeBetween('-3 months', 'now')
    ];
});
