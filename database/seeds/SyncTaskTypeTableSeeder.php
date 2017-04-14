<?php

use App\Models\SyncTaskType;
use Illuminate\Database\Seeder;

class SyncTaskTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    SyncTaskType::create([
		    'id'    => 'Main'
	    ]);

	    SyncTaskType::create([
		    'id'    => 'DataStreamDownload'
	    ]);

	    SyncTaskType::create([
		    'id'    => 'DataStreamCheck'
	    ]);

	    SyncTaskType::create([
		    'id'    => 'DataStreamPrepare'
	    ]);

	    SyncTaskType::create([
		    'id'    => 'ItemsInsertion'
	    ]);

	    SyncTaskType::create([
		    'id'    => 'ItemsUpdate'
	    ]);

	    SyncTaskType::create([
		    'id'    => 'ItemsDelete'
	    ]);
    }
}
