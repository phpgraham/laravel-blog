<?php

use Faker\Generator as Faker;

$factory->define(App\Pages::class, function (Faker $faker) {
    $title = $faker->sentence;

    return [
        'title' => $title,
        'slug' => str_slug($title),
        'content' => $faker->paragraph,
        'public' => 1
    ];
});
