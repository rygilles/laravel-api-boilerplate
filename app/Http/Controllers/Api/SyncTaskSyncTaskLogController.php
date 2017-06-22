<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\IndexSyncTaskSyncTaskLogRequest;
use App\Http\Transformers\Api\SyncTaskLogTransformer;
use App\Models\SyncTask;
use Illuminate\Support\Facades\Auth;

/**
 * @resource SyncTaskLog
 *
 * @package App\Http\Controllers\Api
 */
class SyncTaskSyncTaskLogController extends ApiController
{
	/**
	 * Sync task sync task logs list
	 *
	 * You can specify a GET parameter `public` to filter results (Only allowed for `Developer` and `Support` users).
	 *
	 * @param IndexSyncTaskSyncTaskLogRequest $request
	 * @param string $syncTaskId Sync Task ID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index(IndexSyncTaskSyncTaskLogRequest $request, $syncTaskId)
	{
		$syncTask = SyncTask::authorized(['Owner', 'Administrator'])->where('id', $syncTaskId)->first();

		if (!$syncTask)
			return $this->response->errorNotFound();

		// Only user in groups 'Developer' and 'Support' can filter public/private sync task logs
		if (in_array(Auth::user()->user_group_id, ['Developer', 'Support'])) {
			if ($request->has('public')) {
				if ($request->input('public')) {
					$paginator = $syncTask->syncTaskLogs()->public()->applyRequestQueryString()->paginate();
				} else {
					$paginator = $syncTask->syncTaskLogs()->private()->applyRequestQueryString()->paginate();
				}
			} else {
				$paginator = $syncTask->syncTaskLogs()->applyRequestQueryString()->paginate();
			}
		} else {
			$paginator = $syncTask->syncTaskLogs()->public()->applyRequestQueryString()->paginate();
		}

		return $this->response->paginator($paginator, new SyncTaskLogTransformer);
	}
}
