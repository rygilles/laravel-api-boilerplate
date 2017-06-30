<?php

namespace App\Http\Transformers\Api;

use App\Models\SyncTaskLog;

class SyncTaskLogTransformer extends ApiTransformer
{
	/**
	 * Turn this item object into a generic array
	 *
	 * @param SyncTaskLog $syncTaskLog
	 * @return array
	 */
	public function transform(SyncTaskLog $syncTaskLog)
	{
		return $this->filterWithModelConfiguration(
			SyncTaskLog::class,
			[
				'id'                    => $syncTaskLog->id,
				'sync_task_status_id'   => $syncTaskLog->sync_task_status_id,
				'sync_task_id'          => $syncTaskLog->sync_task_id,
				'entry'                 => $syncTaskLog->entry,
				'public'                => (boolean) $syncTaskLog->public,
				'created_at'            => $syncTaskLog->created_at->toDateTimeString(),
				'updated_at'            => $syncTaskLog->updated_at->toDateTimeString()
			]
		);
	}
}