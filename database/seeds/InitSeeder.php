<?php

use Illuminate\Database\Seeder;

class InitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Initial seeding with required data

        $this->call(I18nLangTableSeeder::class);
	    $this->call(UserGroupTableSeeder::class);
    }
}
