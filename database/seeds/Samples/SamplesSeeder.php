<?php

use Illuminate\Database\Seeder;

class SamplesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed with samples data

	    $this->call(UserTableSeeder::class);
	    $this->call(DataStreamTableSeeder::class);
        $this->call(ProjectTableSeeder::class);
	    $this->call(UserHasProjectTableSeeder::class);
    }
}
