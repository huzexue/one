<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Followers::class, function (Faker $faker) {
    return [
        'user_id'=>mt_rand(1,20),
		'following_id'=>mt_rand(1,20)
    ];
});
