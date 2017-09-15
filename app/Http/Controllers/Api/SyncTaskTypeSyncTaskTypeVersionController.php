<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\SyncTaskTypeVersionTransformer;
use App\Models\SyncTaskType;

/**
 * @resource SyncTaskTypeVersion
 * @OpenApiOperationTag Resource:SyncTaskType
 *
 * @package App\Http\Controllers\Api
 */
class SyncTaskTypeSyncTaskTypeVersionController extends ApiController
{
	/**
	 * Sync task type sync task type versions list
	 *
	 * @OpenApiOperationId getVersions
	 * @OpenApiResponseSchemaRef #/components/schemas/SyncTaskTypeVersionListResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A SyncTaskStatusType list
	 * @OpenApiExtraParameterRef #/components/parameters/Search
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationPage
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationLimit
	 * @OpenApiExtraParameterRef #/components/parameters/OrderBy
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
