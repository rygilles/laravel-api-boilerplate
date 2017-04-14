<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\SyncTaskTransformer;
use App\Models\Project;

/**
 * @resource SyncTask
 *
 * @package App\Http\Controllers\Api
 */
class ProjectSyncTaskController extends ApiController
{
	/**
	 * Project sync task list
	 *
	 * @param string $projectId Project UUID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index($projectId)
	{
		$project = Project::authorized(['Owner', 'Administrator'])->find($projectId);

		if (!$project)
			return $this->response->errorNotFound();

		$paginator = $project->syncTasks()->paginate();

		return $this->response->paginator($paginator, new SyncTaskTransformer);
	}
}
