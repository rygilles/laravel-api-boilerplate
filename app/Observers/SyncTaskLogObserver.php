<?php

namespace App\Observers;

use App\Events\SyncTaskLogCreatedEvent;
use App\Models\SyncTaskLog;

class SyncTaskLogObserver
{
	/**
	 * Listen to the Sync task log created event.
	 *
	 * @param  SyncTaskLog $syncTaskLog
	 * @return void
	 */
	public function created(SyncTaskLog $syncTaskLog)
	{
		broadcast(new SyncTaskLogCreatedEvent($syncTaskLog));
	}
}