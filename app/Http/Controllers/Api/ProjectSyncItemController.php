<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\SyncItemTransformer;
use App\Models\Project;

/**
 * @resource SyncItem
 *
 * @package App\Http\Controllers\Api
 */
class ProjectSyncItemController extends ApiController
{
	/**
	 * Project sync item list
	 *
	 * @param string $projectId Project UUID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index($projectId)
	{
		$project = Project::authorized(['Owner', 'Administrator'])->find($projectId);

		if (!$project)
			return $this->response->errorNotFound();

		$paginator = $project->syncItems()->applyRequestQueryString()->paginate();

		return $this->response->paginator($paginator, new SyncItemTransformer);
	}
}
