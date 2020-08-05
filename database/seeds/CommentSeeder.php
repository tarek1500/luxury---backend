<?php

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Post::all()->each(function ($post) {
			User::inRandomOrder()->take(10)->get()->each(function ($user) use ($post) {
				factory(Comment::class)->create([
					'user_id' => $user->id,
					'post_id' => $post->id
				]);
			});
		});
	}
}