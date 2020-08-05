<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
	return [
		'user_id' => 0,
		'body' => $faker->sentences(3, true)
	];
});