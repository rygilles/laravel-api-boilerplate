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
	    $this->call(DataStreamFieldTableSeeder::class);
        $this->call(ProjectTableSeeder::class);
	    $this->call(UserHasProjectTableSeeder::class);
	    $this->call(SyncItemTableSeeder::class);
	    $this->call(SyncTaskTableSeeder::class);
	    $this->call(SyncTaskLogTableSeeder::class);
	    $this->call(DataStreamPresetTableSeeder::class);
	    $this->call(DataStreamHasI18nLangTableSeeder::class);
	    $this->call(DataStreamPresetFieldTableSeeder::class);
    }
}
