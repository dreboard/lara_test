<?php

use Faker\Generator as Faker;

$factory->define(App\Tag::class, function (Faker $faker) {
    $tags = ['generic', 'php', ];
    return [
        'name' => array_rand($tags)
    ];
});
