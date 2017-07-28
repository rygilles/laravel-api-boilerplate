<?php

namespace App\Http\Transformers\Api;

use App\Models\SyncTask;

class SyncTaskTransformer extends ApiTransformer
{
	/**
	 * Resources that can be included if requested.
	 *
	 * @var array
	 */
	protected $availableIncludes = [
		'createdByUser',
		'project'
	];

	/**
	 * Turn this item object into a generic array
	 *
	 * @param SyncTask $syncTask
	 * @return array
	 */
	public function transform(SyncTask $syncTask)
	{
		return $this->filterWithModelConfiguration(
			SyncTask::class,
			[
				'id'                        => $syncTask->id,
				'sync_task_id'              => $syncTask->sync_task_id,
				'sync_task_type_id'         => $syncTask->sync_task_type_id,
				'sync_task_status_id'       => $syncTask->sync_task_status_id,
				'created_by_user_id'        => $syncTask->created_by_user_id,
				'project_id'                => $syncTask->project_id,
				'planned_at'                => (!is_null($syncTask->planned_at) ? $syncTask->planned_at->toDateTimeString() : null),
				'created_at'                => $syncTask->created_at->toDateTimeString(),
				'updated_at'                => $syncTask->updated_at->toDateTimeString(),
				'sync_task_logs_count'      => (int) $syncTask->sync_task_logs_count,
				'children_sync_tasks_count' => (int) $syncTask->children_sync_tasks_count,
			]
		);
	}

	/**
	 * Include CreatedByUser
	 *
	 * @param SyncTask $syncTask
	 * @return League\Fractal\ItemResource
	 */
	public function includeCreatedByUser(SyncTask $syncTask)
	{
		// Nullable foreign key
		if (is_null($syncTask->created_by_user_id)) {
			return $this->null();
		}

		$createdByUser = $syncTask->createdByUser;

		return $this->item($createdByUser, new UserTransformer);
	}

	/**
	 * Include project
	 *
	 * @param SyncTask $syncTask
	 * @return League\Fractal\ItemResource
	 */
	public function includeProject(SyncTask $syncTask)
	{
		$project = $syncTask->project;

		return $this->item($project, new ProjectTransformer);
	}
}