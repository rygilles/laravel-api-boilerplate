<?php

use App\Models\SyncTaskStatus;
use Illuminate\Database\Seeder;

class SyncTaskStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    SyncTaskStatus::create([
		    'id'    => 'Planned'
	    ]);

	    SyncTaskStatus::create([
		    'id'    => 'InProgress'
	    ]);

	    SyncTaskStatus::create([
		    'id'    => 'Complete'
	    ]);
    }
}
