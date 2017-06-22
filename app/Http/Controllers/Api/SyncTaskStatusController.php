<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreSyncTaskStatusRequest;
use App\Http\Requests\UpdateSyncTaskStatusRequest;
use App\Http\Transformers\Api\SyncTaskStatusTransformer;
use App\Models\SyncTaskStatus;
use Dingo\Api\Exception\ValidationHttpException;

/**
 * @resource SyncTaskStatus
 *
 * @package App\Http\Controllers\Api
 */
class SyncTaskStatusController extends ApiController
{
	/**
	 * I18nLangController constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		// User group restrictions
		$this->middleware('verifyUserGroup:Developer', ['only' => ['store', 'update', 'destroy']]);
	}

	/**
	 * Show sync task status list
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function index()
	{
		$syncTaskStatuses = SyncTaskStatus::applyRequestQueryString()
											->withCount('syncTasks')
											->withCount('syncTaskLogs')
											->withCount('syncTaskStatusVersions')
											->paginate();

		return $this->response->paginator($syncTaskStatuses, new SyncTaskStatusTransformer);
	}

	/**
	 * Get specified sync task status
	 *
	 * @param $syncTaskStatusId string Sync task type ID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function show($syncTaskStatusId)
	{
		$syncTaskStatus = SyncTaskStatus::withCount('syncTasks')
										  ->withCount('syncTaskLogs')
										  ->withCount('syncTaskStatusVersions')
										  ->find($syncTaskStatusId);

		if (!$syncTaskStatus)
			return $this->response->errorNotFound();

		return $this->response->item($syncTaskStatus, new SyncTaskStatusTransformer);
	}

	/**
	 * Create and store new sync task status
	 *
	 * @ApiDocsNoCall
	 *
	 * @param StoreSyncTaskStatusRequest $request
	 * @return \Dingo\Api\Http\Response|void
	 * @throws ValidationHttpException
	 */
	public function store(StoreSyncTaskStatusRequest $request)
	{
		$syncTaskStatus = SyncTaskStatus::create($request->all(), $request->getRealMethod());

		if ($syncTaskStatus) {
			// Register model transformer for created/accepted responses
			// @link https://github.com/dingo/api/issues/1218
			app('Dingo\Api\Transformer\Factory')->register(
				SyncTaskStatus::class,
				SyncTaskStatusTransformer::class
			);

			return $this->response->created(
				app('Dingo\Api\Routing\UrlGenerator')
					->version('v1')
					->route('syncTaskStatus.show', $syncTaskStatus->id),
				$syncTaskStatus);
		}

		return $this->response->errorBadRequest();
	}

	/**
	 * Update a sync task status
	 *
	 * @ApiDocsNoCall
	 *
	 * @param UpdateSyncTaskStatusRequest $request
	 * @param $syncTaskStatusId string Sync task status ID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function update(UpdateSyncTaskStatusRequest $request, $syncTaskStatusId)
	{
		$syncTaskStatus = SyncTaskType::find($syncTaskStatusId);

		if (!$syncTaskStatus)
			return $this->response->errorNotFound();

		$syncTaskStatus->fill($request->all(), $request->getRealMethod());
		$syncTaskStatus->save();

		return $this->response->item($syncTaskStatus, new SyncTaskStatusTransformer);
	}

	/**
	 * Delete specified sync task status
	 *
	 * The sync task status versions will be automatically deleted too.<br />
	 * <aside class="warning">Avoid using this feature ! Check foreign keys constraints to remove dependent resources properly before.</aside>
	 *
	 * @ApiDocsNoCall
	 *
	 * @param $syncTaskStatusId string Sync task status ID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function destroy($syncTaskStatusId)
	{
		$syncTaskStatus = SyncTaskType::find($syncTaskStatusId);

		if (!$syncTaskStatus)
			return $this->response->errorNotFound();

		$syncTaskStatus->delete();

		return $this->response->noContent();
	}
}
