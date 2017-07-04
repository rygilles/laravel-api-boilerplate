<?php

namespace App\DataStreamDecoders;

use App\Models\DataStream;
use App\Models\SyncTask;
use App\SearchEngines\SearchEngine;
use Illuminate\Validation\ValidationException;

/**
 * Decoder interface for DataStreamDecoders classes
 * @package App\DataStreamDecoders
 */
interface Decoder
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
	 * @return
	 */
	public function decodeAndPrepare($localFileName, DataStream $dataStream, SearchEngine $searchEngine,
	                                 SyncTask $itemsInsertionSubSyncTask,
	                                 SyncTask $itemsUpdateSubSyncTask,
	                                 SyncTask $itemsDeleteSubSyncTask);

	/**
	 * Check the file content
	 *
	 * @param string $localFileName local storage filename
	 * @param DataStream $dataStream
	 * @throws ValidationException
	 * @throws \Exception
	 */
	public function check($localFileName, DataStream $dataStream);
}