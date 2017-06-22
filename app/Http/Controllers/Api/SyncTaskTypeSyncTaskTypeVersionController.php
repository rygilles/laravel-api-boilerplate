<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\SyncTaskTypeVersionTransformer;
use App\Models\SyncTaskType;

/**
 * @resource SyncTaskTypeVersion
 *
 * @package App\Http\Controllers\Api
 */
class SyncTaskTypeSyncTaskTypeVersionController extends ApiController
{
	/**
	 * Sync task type sync task type versions list
	 *
	 * @param string $syncTaskTypeId Sync Task Type ID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index($syncTaskTypeId)
	{
		$syncTaskType = SyncTaskType::find($syncTaskTypeId);

		if (!$syncTaskType)
			return $this->response->errorNotFound();

		$paginator = $syncTaskType->syncTaskTypeVersions()->applyRequestQueryString()->paginate();

		return $this->response->paginator($paginator, new SyncTaskTypeVersionTransformer);
	}
}
