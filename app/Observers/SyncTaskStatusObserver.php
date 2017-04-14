<?php

namespace App\Observers;

use App\Models\SyncTaskStatus;

class SyncTaskStatusObserver
{
	/**
	 * Listen to the Sync task status deleting event.
	 *
	 * @param  SyncTaskStatus  $syncTaskStatus
	 * @return void
	 */
	public function deleting(SyncTaskStatus $syncTaskStatus)
	{
		echo('deleting sync task status "' . $syncTaskStatus->id . '"' . "\n");

		// Delete sync tasks status versions
		foreach ($syncTaskStatus->syncTaskStatusVersions()->get() as $syncTaskStatusVersion) {
			$syncTaskStatusVersion->delete();
		}
	}
}