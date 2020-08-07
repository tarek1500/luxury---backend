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
		factory(User::class, 19)->create();
	}
}