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
	 * @param $syncTaskStatusId string Sync Task Status ID
	 * @param $i18nLangId string I18n Lang Id
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
	 * @param UpdateSyncTaskStatusVersionRequest $request
	 * @param $syncTaskStatusId string Sync Task Status ID
	 * @param $i18nLangId string I18n Lang Id
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
	 * @param $syncTaskStatusId string Sync Task Status ID
	 * @param $i18nLangId string I18n Lang Id
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
