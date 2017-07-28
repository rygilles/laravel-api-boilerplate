<?php

use App\Models\SyncTask;
use Carbon\Carbon;
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
		    'sync_task_status_id'   => 'Planned',
		    'created_by_user_id'    => '605c7610-1389-11e7-93ae-92361f002671',
		    'project_id'            => '1bcc7efc-138c-11e7-93ae-92361f002671',
		    'planned_at'            => Carbon::now()->addMinutes(10),
	    ]);

	    // Mickey Mouse Sample Project sync tasks

	    SyncTask::create([
		    'id'                    => 'f542c0e4-729e-11e7-8cf7-a6006ad3dba0',
		    'sync_task_id'          => null,
		    'sync_task_type_id'     => 'Main',
		    'sync_task_status_id'   => 'Planned',
		    'created_by_user_id'    => '82b5da82-138c-11e7-93ae-92361f002671',
		    'project_id'            => 'c4b5d93c-138c-11e7-93ae-92361f002671',
		    'planned_at'            => Carbon::now()->addMinutes(20),
	    ]);

    }
}
