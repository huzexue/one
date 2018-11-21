<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Article::class, function (Faker $faker) {
    return [
		'title'=>$faker->sentence(),
		'user_id'=>mt_rand(1,5),
		'category_id'=>mt_rand(1,4),
		'content'=>$faker->text($maxNbChars = 800),
    ];
});
