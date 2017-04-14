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
		echo('deleting sync task  "' . $syncTask->id . '"' . "\n");

		// Delete sync tasks status versions
		foreach ($syncTask->childrenSyncTask()->get() as $childrenSyncTask) {
			echo('sync task "' . $syncTask->id . '" dissociate sync task "' . $childrenSyncTask->id . '"' . "\n");
			$childrenSyncTask->parentSyncTask()->dissociate();
			$childrenSyncTask->save();
		}
	}
}