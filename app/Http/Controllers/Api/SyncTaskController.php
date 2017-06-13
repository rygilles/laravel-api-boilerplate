<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreSyncTaskRequest;
use App\Http\Requests\UpdateSyncTaskRequest;
use App\Http\Transformers\Api\SyncTaskTransformer;
use App\Models\SyncTask;
use Dingo\Api\Exception\ValidationHttpException;

/**
 * @resource SyncTask
 *
 * @package App\Http\Controllers\Api
 */
class SyncTaskController extends ApiController
{
	/**
	 * SyncTaskController constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		// User group restrictions
		$this->middleware('verifyUserGroup:Developer', ['only' => ['store', 'update', 'destroy']]);
		$this->middleware('verifyUserGroup:Developer,Support', ['only' => ['index', 'show']]);
	}

	/**
	 * Sync task list
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function index()
	{
		$paginator = SyncTask::paginate();

		return $this->response->paginator($paginator, new SyncTaskTransformer);
	}

	/**
	 * Get specified sync task
	 *
	 * @param $syncTaskId string Sync Task ID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function show($syncTaskId)
	{
		$syncTask = SyncTask::find($syncTaskId);

		if (!$syncTask)
			return $this->response->errorNotFound();

		return $this->response->item($syncTask, new SyncTaskTransformer);
	}

	/**
	 * Create and store new sync task
	 *
	 * @ApiDocsNoCall
	 *
	 * @param StoreSyncTaskRequest $request
	 * @return \Dingo\Api\Http\Response|void
	 * @throws ValidationHttpException
	 */
	public function store(StoreSyncTaskRequest $request)
	{
		$syncTask = SyncTask::create($request->all(), $request->getRealMethod());

		if ($syncTask) {
			// Register model transformer for created/accepted responses
			// @link https://github.com/dingo/api/issues/1218
			app('Dingo\Api\Transformer\Factory')->register(
				SyncTask::class,
				SyncTaskTransformer::class
			);

			return $this->response->created(
				app('Dingo\Api\Routing\UrlGenerator')
					->version('v1')
					->route('syncTask.show', $syncTask->id),
				$syncTask);
		}

		return $this->response->errorBadRequest();
	}

	/**
	 * Update a specified sync task
	 *
	 * @ApiDocsNoCall
	 *
	 * @param UpdateSyncTaskRequest $request
	 * @param $syncTaskId string Sync Task ID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function update(UpdateSyncTaskRequest $request, $syncTaskId)
	{
		$syncTask = SyncTask::find($syncTaskId);

		if (!$syncTask)
			return $this->response->errorNotFound();

		$syncTask->fill($request->all(), $request->getRealMethod());
		$syncTask->save();

		return $this->response->item($syncTask, new SyncTaskTransformer);
	}

	/**
	 * Delete specified sync task
	 *
	 * @ApiDocsNoCall
	 *
	 * @param $syncTaskId string Sync Task ID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function destroy($syncTaskId)
	{
		$syncTask = SyncTask::find($syncTaskId);

		if (!$syncTask)
			return $this->response->errorNotFound();

		$syncTask->delete();

		return $this->response->noContent();
	}
}
