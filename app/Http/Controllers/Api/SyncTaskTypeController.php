<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreSyncTaskTypeRequest;
use App\Http\Requests\UpdateSyncTaskTypeRequest;
use App\Http\Transformers\Api\SyncTaskTypeTransformer;
use App\Models\SyncTaskType;
use Dingo\Api\Exception\ValidationHttpException;

/**
 * @resource SyncTaskType
 * @OpenApiOperationTag Manager:SyncTaskType
 *
 * @package App\Http\Controllers\Api
 */
class SyncTaskTypeController extends ApiController
{
	/**
	 * I18nLangController constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		// User group restrictions
		$this->middleware('verifyUserGroup:Developer', ['only' => ['store', 'update', 'destroy']]);;
	}

	/**
	 * Show sync task type list
	 *
	 * @OpenApiOperationId all
	 * @OpenApiResponseSchemaRef #/components/schemas/SyncTaskTypeListResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A SyncTaskType list
	 * @OpenApiExtraParameterRef #/components/parameters/Search
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationPage
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationLimit
	 * @OpenApiExtraParameterRef #/components/parameters/OrderBy
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function index()
	{
		$syncTaskTypes = syncTaskType::applyRequestQueryString()
									   ->withCount('syncTasks')
									   ->withCount('syncTaskTypeVersions')
									   ->paginate();

		return $this->response->paginator($syncTaskTypes, new SyncTaskTypeTransformer);
	}

	/**
	 * Get specified sync task type
	 *
	 * @OpenApiOperationId get
	 * @OpenApiResponseSchemaRef #/components/schemas/SyncTaskTypeResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A SyncTaskType
	 *
	 * @param string $syncTaskTypeId Sync task type ID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function show($syncTaskTypeId)
	{
		$syncTaskType = SyncTaskType::withCount('syncTasks')
									->withCount('syncTaskTypeVersions')
									->find($syncTaskTypeId);

		if (!$syncTaskType)
			return $this->response->errorNotFound();

		return $this->response->item($syncTaskType, new SyncTaskTypeTransformer);
	}

	/**
	 * Create and store new sync task type
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId create
	 * @OpenApiResponseSchemaRef #/components/schemas/SyncTaskTypeResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A SyncTaskType
	 *
	 * @param StoreSyncTaskTypeRequest $request
	 * @return \Dingo\Api\Http\Response|void
	 * @throws ValidationHttpException
	 */
	public function store(StoreSyncTaskTypeRequest $request)
	{
		$syncTaskType = SyncTaskType::create($request->all(), $request->getRealMethod());

		if ($syncTaskType) {
			// Register model transformer for created/accepted responses
			// @link https://github.com/dingo/api/issues/1218
			app('Dingo\Api\Transformer\Factory')->register(
				SyncTaskType::class,
				SyncTaskTypeTransformer::class
			);

			return $this->response->created(
				app('Dingo\Api\Routing\UrlGenerator')
					->version('v1')
					->route('syncTaskType.show', $syncTaskType->id),
				$syncTaskType);
		}

		return $this->response->errorBadRequest();
	}

	/**
	 * Update a sync task type
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId update
	 * @OpenApiOperationTag Resource:SyncTaskType
	 * @OpenApiResponseSchemaRef #/components/schemas/SyncTaskTypeResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription The updated SyncTaskType
	 *
	 * @param UpdateSyncTaskTypeRequest $request
	 * @param string $syncTaskTypeId Sync task type ID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function update(UpdateSyncTaskTypeRequest $request, $syncTaskTypeId)
	{
		$syncTaskType = SyncTaskType::find($syncTaskTypeId);

		if (!$syncTaskType)
			return $this->response->errorNotFound();

		$syncTaskType->fill($request->all(), $request->getRealMethod());
		$syncTaskType->save();

		return $this->response->item($syncTaskType, new SyncTaskTypeTransformer);
	}

	/**
	 * Delete specified sync task type
	 *
	 * The sync task type versions will be automatically deleted too.<br />
	 * <aside class="warning">Avoid using this feature ! Check foreign keys constraints to remove dependent resources properly before.</aside>
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId delete
	 * @OpenApiOperationTag Resource:SyncTaskType
	 * @OpenApiResponseDescription Empty response
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 *
	 * @param string $syncTaskTypeId Sync task type ID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function destroy($syncTaskTypeId)
	{
		$syncTaskType = SyncTaskType::find($syncTaskTypeId);

		if (!$syncTaskType)
			return $this->response->errorNotFound();

		$syncTaskType->delete();

		return $this->response->noContent();
	}
}
