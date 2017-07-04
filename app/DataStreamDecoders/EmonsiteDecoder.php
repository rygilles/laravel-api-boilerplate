<?php

namespace App\DataStreamDecoders;

use App\Models\DataStream;
use App\Models\I18nLang;
use App\Models\Project;
use App\Models\SyncItem;
use App\Models\SyncTask;
use App\Models\SyncTaskItem;
use App\SearchEngines\SearchEngine;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Class EmonsiteDecoder
 * @package App\DataStreamDecoders
 */
class EmonsiteDecoder implements Decoder
{
	/**
	 * Decode the file content and prepare sub-tasks
	 *
	 * @param $localFileName
	 * @param DataStream $dataStream
	 * @param SearchEngine $searchEngine
	 * @param SyncTask $itemsInsertionSubSyncTask
	 * @param SyncTask $itemsUpdateSubSyncTask
	 * @param SyncTask $itemsDeleteSubSyncTask
	 */
	public function decodeAndPrepare($localFileName, DataStream $dataStream, SearchEngine $searchEngine,
	                                 SyncTask $itemsInsertionSubSyncTask,
	                                 SyncTask $itemsUpdateSubSyncTask,
	                                 SyncTask $itemsDeleteSubSyncTask)
	{
		// Load file data
		$data = Storage::disk('syncTasksTempFolder')->get($localFileName);

		// Decode JSON
		$decoded = \GuzzleHttp\json_decode($data, true);

		// Get data stream i18n langs
		/** @var I18nLang[] $dataStreamI18nLangs */
		$dataStreamI18nLangs = $dataStream->i18nLangs()->get();

		// Get data stream fields
		/** @var DataStreamField[] $dataStreamFields */
		$dataStreamFields = $dataStream->dataStreamFields()->get();

		// Get the project sync. items

		/** @var Project $project */
		$project = $dataStream->project()->first();

		/** @var SyncItem[]|Collection $projectSyncItems */
		$projectSyncItems = $project->syncItems()->get();

		/** @var Collection $projectSyncItemsToRemove */
		$projectSyncItemsToRemove = $projectSyncItems->keyBy('item_id');

		foreach ($decoded as $itemID => $itemRow) {
			$syncTaskItemDataArray = [];

			// Validate fields existence
			foreach ($dataStreamFields as $dataStreamField) {
				if ($dataStreamField->versioned) {
					foreach ($dataStreamI18nLangs as $dataStreamI18nLang) {
						$fieldName = $searchEngine->getClientContainerFieldName($dataStreamField, $dataStreamI18nLang->id);
						$versioned_path = $dataStreamField->path . '_' . $dataStreamI18nLang->id;
						$syncTaskItemDataArray[$fieldName] = array_get($itemRow, $versioned_path);
					}
				} else {
					$fieldName = $searchEngine->getClientContainerFieldName($dataStreamField);
					$syncTaskItemDataArray[$fieldName] = array_get($itemRow, $dataStreamField->path);
				}
			}

			// JSON encode
			$jsonEncodedItemData = json_encode($syncTaskItemDataArray);

			// Make MD5 signature
			$item_signature = md5($jsonEncodedItemData);

			// Check if an item with this Id already exists

			$tempCollection = $projectSyncItems->whereStrict('item_id', $itemID);

			if ($tempCollection->count() > 0) {

				$projectSyncItem = $tempCollection->first();

				// Check if the signature is different
				if ($projectSyncItem->item_signature != $item_signature) {
					// Create a new sync. task item for "ItemsUpdate" sub task
					$syncTaskItem = SyncTaskItem::create([
						'item_id'           => $itemID,
						'sync_task_id'      => $itemsUpdateSubSyncTask->id,
						'data'              => $jsonEncodedItemData,
						'item_signature'    => $item_signature,
					]);
				}

				// Remove this item from the project sync items remove collection
				// (the remaining items will be added to the "ItemsDelete" sub task at the end)
				$projectSyncItemsToRemove->forget($itemID);

			} else {
				// Create a new sync. task item for "ItemsInsertion" sub task
				$syncTaskItem = SyncTaskItem::create([
					'item_id'           => $itemID,
					'sync_task_id'      => $itemsInsertionSubSyncTask->id,
					'data'              => $jsonEncodedItemData,
					'item_signature'    => $item_signature,
				]);
			}
		}

		foreach ($projectSyncItemsToRemove as $projectSyncItemToRemove) {
			// Create a new sync. task item for "ItemsDelete" sub task
			$syncTaskItem = SyncTaskItem::create([
				'item_id'           => $projectSyncItemToRemove->item_id,
				'sync_task_id'      => $itemsDeleteSubSyncTask->id,
			]);
		}
	}

	/**
	 * Check the file content
	 *
	 * @param string $localFileName local storage filename
	 * @param DataStream $dataStream
	 * @throws ValidationException
	 * @throws \Exception
	 */
	public function check($localFileName, DataStream $dataStream)
	{
		// Load file data
		$data = Storage::disk('syncTasksTempFolder')->get($localFileName);

		// Validate JSON
		$validator = Validator::make(['data' => $data], [
			'data' => 'json'
		]);

		if ($validator->fails()) {
			throw new ValidationException($validator);
		}

		$decoded = \GuzzleHttp\json_decode($data, true);

		// Get data stream i18n langs
		/** @var I18nLang[] $dataStreamI18nLangs */
		$dataStreamI18nLangs = $dataStream->i18nLangs();

		// Get data stream fields
		/** @var DataStreamField[] $dataStreamFields */
		$dataStreamFields = $dataStream->dataStreamFields();

		foreach ($decoded as $itemID => $itemRow) {
			// Validate item ID
			$validator = Validator::make(['itemID' => $itemID], [
				'itemID' => 'hex|size:24'
			]);

			if ($validator->fails()) {
				throw new ValidationException($validator);
			}

			// Validate fields existence
			foreach ($dataStreamFields as $dataStreamField) {
				if ($dataStreamField->versioned) {
					foreach ($dataStreamI18nLangs as $dataStreamI18nLang) {
						$versioned_path = $dataStreamField->path . '_' . $dataStreamI18nLang->id;
						if (!array_has($itemRow, $versioned_path)) {
							throw new \Exception('"' . $dataStreamField->name . '" field not found with path "' . $versioned_path . '" (versioned) for item ID "' . $itemID . '"');
						}
					}
				} else {
					if (!array_has($itemRow, $dataStreamField->path)) {
						throw new \Exception('"' . $dataStreamField->name . '" field not found with path "' . $dataStreamField->path . '" for item ID "' . $itemID . '"');
					}
				}
			}
		}
	}
}