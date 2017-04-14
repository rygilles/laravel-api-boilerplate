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
        $this->call(SearchEngineTableSeeder::class);
	    $this->call(UserGroupTableSeeder::class);
	    $this->call(UserRoleTableSeeder::class);
	    $this->call(SyncTaskTypeTableSeeder::class);
	    $this->call(SyncTaskTypeVTableSeeder::class);
	    $this->call(SyncTaskStatusTableSeeder::class);
	    $this->call(SyncTaskStatusVTableSeeder::class);
    }
}
