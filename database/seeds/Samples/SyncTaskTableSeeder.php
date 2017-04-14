<?php

use App\Models\SyncTask;
use Illuminate\Database\Seeder;

class SyncTaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    // John Smith Sample Project 1 sync tasks

	    SyncTask::create([
		    'id'                    => '8dbfd6e6-2055-11e7-93ae-92361f002671',
		    'sync_task_id'          => null,
		    'sync_task_type_id'     => 'Main',
		    'sync_task_status_id'   => 'InProgress',
		    'created_by_user_id'    => '605c7610-1389-11e7-93ae-92361f002671',
		    'project_id'            => '1bcc7efc-138c-11e7-93ae-92361f002671',
	    ]);

	    SyncTask::create([
		    'id'                    => '91bf2f58-2055-11e7-93ae-92361f002671',
		    'sync_task_id'          => '8dbfd6e6-2055-11e7-93ae-92361f002671',
		    'sync_task_type_id'     => 'DataStreamDownload',
		    'sync_task_status_id'   => 'InProgress',
		    'created_by_user_id'    => '605c7610-1389-11e7-93ae-92361f002671',
		    'project_id'            => '1bcc7efc-138c-11e7-93ae-92361f002671',
	    ]);
    }
}
