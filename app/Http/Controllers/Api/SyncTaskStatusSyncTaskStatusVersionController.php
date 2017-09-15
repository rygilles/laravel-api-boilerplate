<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\SyncTaskStatusVersionTransformer;
use App\Models\SyncTaskStatus;

/**
 * @resource SyncTaskStatusVersion
 * @OpenApiOperationTag Resource:SyncTaskStatus
 *
 * @package App\Http\Controllers\Api
 */
class SyncTaskStatusSyncTaskStatusVersionController extends ApiController
{
	/**
	 * Sync task status sync task status versions list
	 *
	 * @OpenApiOperationId getVersions
	 * @OpenApiResponseSchemaRef #/components/schemas/SyncTaskStatusVersionListResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A SyncTaskStatusVersion list
	 * @OpenApiExtraParameterRef #/components/parameters/Search
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationPage
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationLimit
	 * @OpenApiExtraParameterRef #/components/parameters/OrderBy 
	 *
	 * @param string $syncTaskStatusId Sync Task Status ID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index($syncTaskStatusId)
	{
		$syncTaskStatus = SyncTaskStatus::find($syncTaskStatusId);

		if (!$syncTaskStatus)
			return $this->response->errorNotFound();

		$paginator = $syncTaskStatus->syncTaskStatusVersions()->applyRequestQueryString()->paginate();

		return $this->response->paginator($paginator, new SyncTaskStatusVersionTransformer);
	}
}
