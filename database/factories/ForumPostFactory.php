<?php

use Faker\Generator as Faker;

$factory->define(App\Models\ForumPost::class, function (Faker $faker) {

    $text = $faker->realText(rand(100, 200));
    $isPublished = rand(1, 10) > 1;
    $createdAt = $faker->dateTimeBetween('-3 months', '-2 months');

    $data = [
        'category_id'   =>  1,
        'user_id'       =>  rand(1, 30),
        'country_id'    =>  rand(1, 10),
        'text'          =>  $text,
        'is_published'  =>  $isPublished,
        'published_at'  =>  $isPublished ? $faker->dateTimeBetween('-2 months', '-1 days') : null,
        'created_at'    =>  $createdAt,
        'updated_at'    =>  $createdAt,
    ];

    return $data;
});
