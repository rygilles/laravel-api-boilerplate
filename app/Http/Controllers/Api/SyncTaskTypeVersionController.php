<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreSyncTaskTypeVersionRequest;
use App\Http\Requests\UpdateSyncTaskTypeVersionRequest;
use App\Http\Transformers\Api\SyncTaskTypeVersionTransformer;
use App\Models\SyncTaskTypeVersion;
use Dingo\Api\Exception\ValidationHttpException;

/**
 * @resource SyncTaskTypeVersion
 *
 * @package App\Http\Controllers\Api
 */
class SyncTaskTypeVersionController extends ApiController
{
	/**
	 * SyncTaskTypeVersionController constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		// User group restrictions
		$this->middleware('verifyUserGroup:Developer')->only('destroy');
		$this->middleware('verifyUserGroup:Developer,Support')->only('store,update,destroy');
	}

	/**
	 * Sync task type version item list
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function index()
	{
		$paginator = SyncTaskTypeVersion::paginate();

		return $this->response->paginator($paginator, new SyncTaskTypeVersionTransformer);
	}

	/**
	 * Get specified sync task type version
	 *
	 * @param $syncTaskTypeId string Sync Task Type ID
	 * @param $i18nLangId string I18n Lang Id
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function show($syncTaskTypeId, $i18nLangId)
	{
		$syncTaskTypeVersion = SyncTaskTypeVersion::where('sync_task_type_id', $syncTaskTypeId)->where('i18n_lang_id', $i18nLangId)->get();

		if (!$syncTaskTypeVersion)
			return $this->response->errorNotFound();

		return $this->response->item($syncTaskTypeVersion, new SyncTaskTypeVersionTransformer);
	}

	/**
	 * Create and store new sync task type version
	 *
	 * @ApiDocsNoCall
	 *
	 * @param StoreSyncTaskTypeVersionRequest $request
	 * @return \Dingo\Api\Http\Response|void
	 * @throws ValidationHttpException
	 */
	public function store(StoreSyncTaskTypeVersionRequest $request)
	{
		$syncTaskTypeVersion = SyncTaskTypeVersion::create($request->all(), $request->getRealMethod());

		if ($syncTaskTypeVersion) {
			// Register model transformer for created/accepted responses
			// @link https://github.com/dingo/api/issues/1218
			app('Dingo\Api\Transformer\Factory')->register(
				SyncTaskTypeVersion::class,
				SyncTaskTypeVersionTransformer::class
			);

			return $this->response->created(
				app('Dingo\Api\Routing\UrlGenerator')
					->version('v1')
					->route('$syncTaskTypeVersion.show', $syncTaskTypeVersion->sync_task_type_id, $syncTaskTypeVersion->i18n_lang_id),
				$syncTaskTypeVersion);
		}

		return $this->response->errorBadRequest();
	}

	/**
	 * Update a specified sync task type version
	 *
	 * @ApiDocsNoCall
	 *
	 * @param UpdateSyncTaskTypeVersionRequest $request
	 * @param $syncTaskTypeId string Sync Task Type ID
	 * @param $i18nLangId string I18n Lang Id
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function update(UpdateSyncTaskTypeVersionRequest $request, $syncTaskTypeId, $i18nLangId)
	{
		$syncTaskTypeVersion = SyncTaskTypeVersion::where('sync_task_type_id', $syncTaskTypeId)->where('i18n_lang_id', $i18nLangId)->get();

		if (!$syncTaskTypeVersion)
			return $this->response->errorNotFound();

		$syncTaskTypeVersion->fill($request->all(), $request->getRealMethod());
		$syncTaskTypeVersion->save();

		return $this->response->item($syncTaskTypeVersion, new SyncTaskTypeVersionTransformer);
	}

	/**
	 * Delete specified sync task type version
	 *
	 * @ApiDocsNoCall
	 *
	 * @param $syncTaskTypeId string Sync Task Type ID
	 * @param $i18nLangId string I18n Lang Id
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function destroy($syncTaskTypeId, $i18nLangId)
	{
		$syncTaskTypeVersion = SyncTaskTypeVersion::where('sync_task_type_id', $syncTaskTypeId)->where('i18n_lang_id', $i18nLangId)->get();

		if (!$syncTaskTypeVersion)
			return $this->response->errorNotFound();

		$syncTaskTypeVersion->delete();

		return $this->response->noContent();
	}
}
