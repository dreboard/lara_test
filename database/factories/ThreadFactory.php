<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

$factory->define(App\Thread::class, function (Faker $faker) {
    $users = App\User::pluck('id');
    return [
        'user_id' => $users->random(),
        'title' => $faker->words(3, true), // words($nb = 3, $asText = false)
        'body' => $faker->paragraph,
    ];
});
