<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreSyncTaskStatusVersionRequest;
use App\Http\Requests\UpdateSyncTaskStatusVersionRequest;
use App\Http\Transformers\Api\SyncTaskStatusVersionTransformer;
use App\Models\SyncTaskStatusVersion;
use Illuminate\Support\Facades\Validator;
use Dingo\Api\Exception\ValidationHttpException;

/**
 * @resource SyncTaskStatusVersion
 * @OpenApiOperationTag Manager:SyncTaskStatusVersion
 *
 * @package App\Http\Controllers\Api
 */
class SyncTaskStatusVersionController extends ApiController
{
	/**
	 * SyncTaskStatusVersionController constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		// User group restrictions
		$this->middleware('verifyUserGroup:Developer', ['only' => ['destroy']]);
		$this->middleware('verifyUserGroup:Developer,Support', ['only' => ['store', 'update']]);
	}

	/**
	 * Sync task status version item list
	 *
	 * @OpenApiOperationId all
	 * @OpenApiResponseSchemaRef #/components/schemas/SyncTaskStatusVersionListResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A SyncTaskStatusVersion list
	 * @OpenApiExtraParameterRef #/components/parameters/Search
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationPage
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationLimit
	 * @OpenApiExtraParameterRef #/components/parameters/OrderBy
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function index()
	{
		$paginator = SyncTaskStatusVersion::applyRequestQueryString()->paginate();

		return $this->response->paginator($paginator, new SyncTaskStatusVersionTransformer);
	}

	/**
	 * Get specified sync task status version
	 *
	 * @OpenApiOperationId get
	 * @OpenApiResponseSchemaRef #/components/schemas/SyncTaskStatusVersionResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A SyncTaskStatusVersion
	 *
	 * @param string $syncTaskStatusId Sync Task Status ID
	 * @param string $i18nLangId I18n Lang Id
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function show($syncTaskStatusId, $i18nLangId)
	{
		$syncTaskStatusVersion = SyncTaskStatusVersion::where('sync_task_status_id', $syncTaskStatusId)->where('i18n_lang_id', $i18nLangId)->get();

		if (!$syncTaskStatusVersion)
			return $this->response->errorNotFound();

		return $this->response->item($syncTaskStatusVersion, new SyncTaskStatusVersionTransformer);
	}

	/**
	 * Create and store new sync task status version
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId create
	 * @OpenApiResponseSchemaRef #/components/schemas/SyncTaskStatusVersionResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A SyncTaskStatusVersion
	 *
	 * @param StoreSyncTaskStatusVersionRequest $request
	 * @return \Dingo\Api\Http\Response|void
	 * @throws ValidationHttpException
	 */
	public function store(StoreSyncTaskStatusVersionRequest $request)
	{
		$syncTaskStatusVersion = SyncTaskStatusVersion::create($request->all(), $request->getRealMethod());

		if ($syncTaskStatusVersion) {
			// Register model transformer for created/accepted responses
			// @link https://github.com/dingo/api/issues/1218
			app('Dingo\Api\Transformer\Factory')->register(
				SyncTaskStatusVersion::class,
				SyncTaskStatusVersionTransformer::class
			);

			return $this->response->created(
				app('Dingo\Api\Routing\UrlGenerator')
					->version('v1')
					->route('syncTaskStatusVersion.show', $syncTaskStatusVersion->sync_task_status_id, $syncTaskStatusVersion->i18n_lang_id),
				$syncTaskStatusVersion);
		}

		return $this->response->errorBadRequest();
	}

	/**
	 * Update a specified sync task status version
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId update
	 * @OpenApiOperationTag Resource:SyncTaskStatusVersion
	 * @OpenApiResponseSchemaRef #/components/schemas/SyncTaskStatusVersionResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription The updated SyncTaskStatusVersion
	 *
	 * @param UpdateSyncTaskStatusVersionRequest $request
	 * @param string $syncTaskStatusId Sync Task Status ID
	 * @param string $i18nLangId I18n Lang Id
	 * @return \Dingo\Api\Http\Response|void
	 * @throws ValidationHttpException
	 */
	public function update(UpdateSyncTaskStatusVersionRequest $request, $syncTaskStatusId, $i18nLangId)
	{
		$syncTaskStatusVersion = SyncTaskStatusVersion::where('sync_task_status_id', $syncTaskStatusId)->where('i18n_lang_id', $i18nLangId)->first();

		if (!$syncTaskStatusVersion)
			return $this->response->errorNotFound();

		// 'unique_with...' in controller method to manage "ignore" parameter.*
		$validator = Validator::make($request->all(), [
			'sync_task_status_id' => 'unique_with:sync_task_status_v,i18n_lang_id,ignore:' . $i18nLangId . ' = i18n_lang_id'
		]);

		if ($validator->fails()) {
			throw new ValidationHttpException($validator->errors());
		}

		$syncTaskStatusVersion->fill($request->all(), $request->getRealMethod());
		$syncTaskStatusVersion->save();

		return $this->response->item($syncTaskStatusVersion, new SyncTaskStatusVersionTransformer);
	}

	/**
	 * Delete specified sync task status version
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId delete
	 * @OpenApiOperationTag Resource:SyncTaskStatusVersion
	 * @OpenApiResponseDescription Empty response
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 *
	 * @param string $syncTaskStatusId Sync Task Status ID
	 * @param string $i18nLangId I18n Lang Id
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function destroy($syncTaskStatusId, $i18nLangId)
	{
		$syncTaskStatusVersion = SyncTaskTypeVersion::where('sync_task_status_id', $syncTaskStatusId)->where('i18n_lang_id', $i18nLangId)->get();

		if (!$syncTaskStatusVersion)
			return $this->response->errorNotFound();

		$syncTaskStatusVersion->delete();

		return $this->response->noContent();
	}
}
