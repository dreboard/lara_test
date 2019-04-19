<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Team::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
    ];
});
