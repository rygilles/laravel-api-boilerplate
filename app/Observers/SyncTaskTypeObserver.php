<?php

namespace App\Observers;

use App\Models\SyncTaskType;

class SyncTaskTypeObserver
{
	/**
	 * Listen to the Sync task type deleting event.
	 *
	 * @param  SyncTaskType  $syncTaskType
	 * @return void
	 */
	public function deleting(SyncTaskType $syncTaskType)
	{
		echo('deleting sync task type "' . $syncTaskType->id . '"' . "\n");

		// Delete sync tasks type versions
		foreach ($syncTaskType->syncTaskTypeVersions()->get() as $syncTaskTypeVersion) {
			$syncTaskTypeVersion->delete();
		}
	}
}