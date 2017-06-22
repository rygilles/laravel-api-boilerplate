<?php

use App\Models\SyncTaskLog;
use Illuminate\Database\Seeder;

class SyncTaskLogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    // John Smith Sample Project 1 sync task logs

	    SyncTaskLog::create([
		    'id'                    => 'bfbf48da-210d-11e7-93ae-92361f002671',
		    'sync_task_status_id'   => 'Planned',
		    'sync_task_id'          => '8dbfd6e6-2055-11e7-93ae-92361f002671',
		    'entry'                 => 'Synchronization planned.',
		    'public'                => true,
	    ]);

	    // Sleep (created_at will be the same else)
	    sleep(2);

	    SyncTaskLog::create([
		    'id'                    => 'c8fd9a1e-210d-11e7-93ae-92361f002671',
		    'sync_task_status_id'   => 'InProgress',
		    'sync_task_id'          => '8dbfd6e6-2055-11e7-93ae-92361f002671',
		    'entry'                 => 'Synchronization in progress.',
		    'public'                => true,
	    ]);

	    // Sleep (created_at will be the same else)
	    sleep(2);

	    SyncTaskLog::create([
		    'id'                    => '893902bc-568f-11e7-907b-a6006ad3dba0',
		    'sync_task_status_id'   => 'InProgress',
		    'sync_task_id'          => '91bf2f58-2055-11e7-93ae-92361f002671',
		    'entry'                 => 'Downloading in progress.',
		    'public'                => true,
	    ]);
    }
}
