<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\SyncTaskStatusVersionTransformer;
use App\Models\SyncTaskStatus;

/**
 * @resource SyncTaskStatusVersion
 *
 * @package App\Http\Controllers\Api
 */
class SyncTaskStatusSyncTaskStatusVersionController extends ApiController
{
	/**
	 * Sync task status sync task status versions list
	 *
	 * @param string $syncTaskStatusId Sync Task Status ID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index($syncTaskStatusId)
	{
		$syncTaskStatus = SyncTaskStatus::find($syncTaskStatusId);

		if (!$syncTaskStatus)
			return $this->response->errorNotFound();

		$paginator = $syncTaskStatus->syncTaskStatusVersions()->paginate();

		return $this->response->paginator($paginator, new SyncTaskStatusVersionTransformer);
	}
}
