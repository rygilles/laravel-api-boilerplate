<?php

namespace App\Observers;

use App\Models\SyncTask;

class SyncTaskObserver
{
	/**
	 * Listen to the Sync task deleting event.
	 *
	 * @param  SyncTask  $syncTask
	 * @return void
	 */
	public function deleting(SyncTask $syncTask)
	{
		// Delete sync tasks status versions
		foreach ($syncTask->childrenSyncTasks()->get() as $childrenSyncTask) {
			$childrenSyncTask->parentSyncTask()->dissociate();
			$childrenSyncTask->save();
		}
	}
}