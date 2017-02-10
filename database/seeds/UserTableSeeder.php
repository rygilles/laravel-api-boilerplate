<?php

use App\Models\User;
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
            'name'      => 'John Doe',
            'email'     => 'john.doe@domain.tld',
            'password'  => 'johndoe' // Magic setter auto crypt
        ]);

        User::create([
            'name'      => 'Alan Smithee',
            'email'     => 'alan.smithee@domain.tld',
            'password'  => 'alansmithee' // Magic setter auto crypt
        ]);

        User::create([
            'name'      => 'John Smith',
            'email'     => 'john.smith@domain.tld',
            'password'  => 'johnsmith' // Magic setter auto crypt
        ]);
    }
}