<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		User::create([
			'id'                    => '41abdec2-1389-11e7-93ae-92361f002671',
			'user_group_id'         => 'Developer',
			'name'                  => 'John Doe',
			'email'                 => 'john.doe@domain.tld',
			'password'              => 'johndoe', // Magic setter auto crypt
			'preferred_language'    => 'en',
			'confirmed_at'          => Carbon::now()
		]);

		User::create([
			'id'                    => '509dd5c0-1389-11e7-93ae-92361f002671',
			'user_group_id'         => 'Support',
			'name'                  => 'Alan Smithee',
			'email'                 => 'alan.smithee@domain.tld',
			'password'              => 'alansmithee', // Magic setter auto crypt
			'preferred_language'    => 'fr',
			'confirmed_at'          => Carbon::now()
		]);

		User::create([
			'id'                    => '605c7610-1389-11e7-93ae-92361f002671',
			'user_group_id'         => 'End-User',
			'name'                  => 'John Smith',
			'email'                 => 'john.smith@domain.tld',
			'password'              => 'johnsmith', // Magic setter auto crypt
			'preferred_language'    => 'en',
			'confirmed_at'          => Carbon::now()
		]);

		User::create([
			'id'                    => '82b5da82-138c-11e7-93ae-92361f002671',
			'user_group_id'         => 'End-User',
			'name'                  => 'Mickey Mouse',
			'email'                 => 'mickey.mouse@domain.tld',
			'password'              => 'mickeymouse', // Magic setter auto crypt
			'preferred_language'    => 'fr',
			'confirmed_at'          => Carbon::now()
		]);
	}
}