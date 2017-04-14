<?php

namespace App\Http\Transformers\Api;

use App\Models\SyncTask;

class SyncTaskTransformer extends ApiTransformer
{
	/**
	 * Turn this item object into a generic array
	 *
	 * @param SyncTask $syncTask
	 * @return array
	 */
	public function transform(SyncTask $syncTask)
	{
		return $this->filterWithModelConfiguration(
			Project::class,
			[
				'id'                    => $syncTask->id,
				'sync_task_id'          => $syncTask->sync_task_id,
				'sync_task_type_id'     => $syncTask->sync_task_type_id,
				'sync_task_status_id'   => $syncTask->sync_task_status_id,
				'created_by_user_id'    => $syncTask->created_by_user_id,
				'project_id'            => $syncTask->project_id,
				'created_at'            => $syncTask->created_at->toDateTimeString(),
				'updated_at'            => $syncTask->updated_at->toDateTimeString()
			]
		);
	}
}