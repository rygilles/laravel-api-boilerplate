<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\SyncTaskTransformer;
use App\Models\SyncTask;
use Illuminate\Support\Facades\Auth;

/**
 * @resource SyncTask
 *
 * @package App\Http\Controllers\Api
 */
class SyncTaskSyncTaskController extends ApiController
{
	/**
	 * SyncTaskSyncTaskController constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		// User group restrictions
		$this->middleware('verifyUserGroup:Developer,Support', ['only' => ['index']]);
	}

	/**
	 * Sync task sync task children list
	 *
	 * @param string $syncTaskId Sync Task ID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index($syncTaskId)
	{
		$syncTask = SyncTask::authorized(['Owner', 'Administrator'])->find($syncTaskId);

		if (!$syncTask)
			return $this->response->errorNotFound();

		$paginator = $syncTask->childrenSyncTasks()
							  ->withCount('childrenSyncTasks')
							  ->withCount('syncTaskLogs')
							  ->applyRequestQueryString()
							  ->paginate();


		return $this->response->paginator($paginator, new SyncTaskTransformer);
	}
}
