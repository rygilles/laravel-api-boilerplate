<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreSyncItemRequest;
use App\Http\Requests\UpdateSyncItemRequest;
use App\Http\Transformers\Api\SyncItemTransformer;
use App\Models\SyncItem;
use Dingo\Api\Exception\ValidationHttpException;

/**
 * @resource SyncItem
 *
 * @package App\Http\Controllers\Api
 */
class SyncItemController extends ApiController
{
	/**
	 * SyncItemController constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		// User group restrictions
		$this->middleware('verifyUserGroup:Developer')->only('store,update,destroy');
		$this->middleware('verifyUserGroup:Developer,Support')->only('index,show');
	}

	/**
	 * Sync item list
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function index()
	{
		$paginator = SyncItem::paginate();

		return $this->response->paginator($paginator, new SyncItemTransformer);
	}

	/**
	 * Get specified sync item
	 *
	 * @param $syncItemId string Sync Item ID
	 * @param $projectId string Project UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function show($syncItemId, $projectId)
	{
		$syncItem = SyncItem::where('item_id', $syncItemId)->where('project_id', $projectId)->get();

		if (!$syncItem)
			return $this->response->errorNotFound();

		return $this->response->item($syncItem, new SyncItemTransformer);
	}

	/**
	 * Create and store new sync item
	 *
	 * @ApiDocsNoCall
	 *
	 * @param StoreSyncItemRequest $request
	 * @return \Dingo\Api\Http\Response|void
	 * @throws ValidationHttpException
	 */
	public function store(StoreSyncItemRequest $request)
	{
		$syncItem = SyncItem::create($request->all(), $request->getRealMethod());

		if ($syncItem) {
			// Register model transformer for created/accepted responses
			// @link https://github.com/dingo/api/issues/1218
			app('Dingo\Api\Transformer\Factory')->register(
				SyncItem::class,
				SyncItemTransformer::class
			);

			return $this->response->created(
				app('Dingo\Api\Routing\UrlGenerator')
					->version('v1')
					->route('syncItem.show', $syncItem->item_id, $syncItem->project_id),
				$syncItem);
		}

		return $this->response->errorBadRequest();
	}

	/**
	 * Update a specified sync item
	 *
	 * @ApiDocsNoCall
	 *
	 * @param UpdateSyncItemRequest $request
	 * @param $syncItemId string Sync Item ID
	 * @param $projectId string Project UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function update(UpdateSyncItemRequest $request, $syncItemId, $projectId)
	{
		$syncItem = SyncItem::where('item_id', $syncItemId)->where('project_id', $projectId)->get();

		if (!$syncItem)
			return $this->response->errorNotFound();

		$syncItem->fill($request->all(), $request->getRealMethod());
		$syncItem->save();

		return $this->response->item($syncItem, new SyncItemTransformer);
	}

	/**
	 * Delete specified sync item
	 *
	 * @ApiDocsNoCall
	 *
	 * @param $syncItemId string Sync Item ID
	 * @param $projectId string Project UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function destroy($syncItemId, $projectId)
	{
		$syncItem = SyncItem::where('item_id', $syncItemId)->where('project_id', $projectId)->get();

		if (!$syncItem)
			return $this->response->errorNotFound();

		$syncItem->delete();

		return $this->response->noContent();
	}
}
