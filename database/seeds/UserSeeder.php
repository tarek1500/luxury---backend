<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(User::class)->create([
			'name' => 'Tarek Ibrahem',
			'email' => 'tarek@domain.com',
			'country' => 'Egypt'
		]);
		factory(User::class)->create([
			'name' => 'Mohammed Ahmed',
			'email' => 'mohammed@domain.com',
			'country' => 'Egypt'
		]);
		factory(User::class)->create([
			'name' => 'Bob',
			'email' => 'bob@domain.com',
			'country' => 'USA'
		]);
		factory(User::class)->create([
			'name' => 'Jack',
			'email' => 'jack@domain.com',
			'country' => 'UK'
		]);
		factory(User::class, 16)->create();
	}
}