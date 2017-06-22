<?php

namespace App\Http\Transformers\Api;

use App\Models\SyncTaskStatus;

class SyncTaskStatusTransformer extends ApiTransformer
{
	/**
	 * Turn this item object into a generic array
	 *
	 * @param SyncTaskStatus $syncTaskStatus
	 * @return array
	 */
	public function transform(SyncTaskStatus $syncTaskStatus)
	{
		return $this->filterWithModelConfiguration(
			SyncTaskStatus::class,
			[
				'id'                                => $syncTaskStatus->id,
				'sync_tasks_count'                  => (int) $syncTaskStatus->sync_tasks_count,
				'sync_task_logs_count'              => (int) $syncTaskStatus->sync_task_logs_count,
				'sync_task_status_versions_count'   => (int) $syncTaskStatus->sync_task_status_versions_count,
			]
		);
	}
}