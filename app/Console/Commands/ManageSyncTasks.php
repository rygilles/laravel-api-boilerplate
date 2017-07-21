<?php

namespace App\Console\Commands;

use App\DataStreamDecoders\Decoder;
use App\Models\DataStream;
use App\Models\DataStreamDecoder;
use App\Models\Project;
use App\Models\SyncTask;
use App\SearchEngines\SearchEngine;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ManageSyncTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:manageSyncTasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manage projects synchronization tasks jobs';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
	    // Start planned main sync. tasks
	    $this->startPlannedMainSyncTasks();

	    // Start/Manage all kind of sub-tasks

	    $subSyncTaskTypesIds = [
		    'DataStreamDownload',
		    'DataStreamCheck',
		    'DataStreamPrepare',
		    'ItemsInsertion',
		    'ItemsUpdate',
		    'ItemsDelete',
	    ];

	    foreach ($subSyncTaskTypesIds as $subSyncTaskTypeId) {
		    $this->manageSubSyncTasks($subSyncTaskTypeId);
	    }

	    // Check "InProgress" main sync. tasks
	    $this->checkInProgressMainSyncTasks();
    }

	/**
	 * Start planned main sync. tasks
	 */
	public function startPlannedMainSyncTasks()
	{
		// Get the count of main sync. tasks "InProgress"
	    $inProgressMainSyncTasksCount = SyncTask::where('sync_task_type_id', 'Main')
											    ->where('sync_task_status_id', 'InProgress')
											    ->count();

	    // Skip planned main sync. task start if over the limit

	    if ($inProgressMainSyncTasksCount < config('app.syncTasksScheduling.maxInProgress.Main')) {

		    // Get oldest main sync. tasks planned, limited by the max allowed "InProgress" task at the same time
		    $plannedMainSyncTasks = SyncTask::where('sync_task_type_id', 'Main')
										    ->where('sync_task_status_id', 'Planned')
			                                ->take(config('app.syncTasksScheduling.maxInProgress.Main') - $inProgressMainSyncTasksCount)
			                                ->orderBy('created_at', 'ASC')
										    ->get();

		    // Start the planned main sync. tasks
		    foreach ($plannedMainSyncTasks as $plannedMainSyncTask) {
			    $this->startPlannedMainSyncTask($plannedMainSyncTask);
		    }
	    }
	}

	/**
	 * Start a planned main sync. task
	 *
	 * Set the main task to "InProgress" status and create the first sub-task : "DataStreamDownload"
	 *
	 * @param SyncTask $plannedMainSyncTask
	 */
	private function startPlannedMainSyncTask(SyncTask $plannedMainSyncTask)
	{
		$this->info('Starting planned "Main" sync task [' . $plannedMainSyncTask->id . ']');

		$this->info("\t" . 'Updating status to "InProgress"');

		// Set this task to "InProgress" status
		$plannedMainSyncTask->sync_task_status_id = 'InProgress';
		$plannedMainSyncTask->save();

		// Log
		$plannedMainSyncTask->createLog('Sync. task started', true);

		$this->info("\t" . 'Creating "DataStreamDownload" sub-task');

		// Create the first sub-task of the process : "DataStreamDownload"
		$plannedMainSyncTask->createSubTask('DataStreamDownload');
	}

	/**
	 * Check "InProgress" main sync. tasks
	 */
	public function checkInProgressMainSyncTasks()
	{
		// Get the current "InProgress" main sync. tasks
		$inProgressMainSyncTasks = SyncTask::where('sync_task_type_id', 'Main')
			->where('sync_task_status_id', 'InProgress')
			->orderBy('created_at', 'ASC')
			->get();

		// Check the "InProgress" main sync. tasks
		foreach ($inProgressMainSyncTasks as $inProgressMainSyncTask) {
			$this->checkInProgressMainSyncTask($inProgressMainSyncTask);
		}
	}

	/**
	 * Check a "InProgress" main sync. task
	 *
	 * Set the main sync. task status to "Complete" if all the sub tasks are finished.
	 * "DataStreamPrepare" sub task and the next sub task. ("ItemsInsertion", "ItemsUpdate", "ItemsDelete") must be complete.
	 *
	 * @param SyncTask $inProgressMainSyncTask
	 * @return bool
	 */
	private function checkInProgressMainSyncTask(SyncTask $inProgressMainSyncTask)
	{
		$this->info('Checking in progress "Main" sync task [' . $inProgressMainSyncTask->id . ']');

		$this->info("\t" . 'Checking if "DataStreamPrepare" sync. sub-task exists and is complete.');

		$dataStreamPrepareComplete = $inProgressMainSyncTask->childrenSyncTasks()
															->where('sync_task_type_id', 'DataStreamPrepare')
															->where('sync_task_status_id', 'Complete')
															->exists();

		if (!$dataStreamPrepareComplete) {
			$this->info("\t" . 'No, so the main sync. task is still in progress.');
			return false;
		}

		$this->info("\t" . '"DataStreamPrepare" sync. sub-task exists and is complete.');

		$this->info("\t" . 'Checking if the next sync. sub-tasks ("ItemsInsertion", "ItemsUpdate", "ItemsDelete") exists and are complete.');

		$nextSubSyncTasks = $inProgressMainSyncTask->childrenSyncTasks()
												   ->whereIn('sync_task_type_id', ['ItemsInsertion', 'ItemsUpdate', 'ItemsDelete'])
												   ->get();

		if (count($nextSubSyncTasks) == 0) {
			$this->info("\t" . 'There are no sync. sub-task.');
		} else {
			foreach ($nextSubSyncTasks as $nextSubSyncTask) {
				$this->info("\t\t" . 'Sync. sub-task [' . $nextSubSyncTask->id . '] "' . $nextSubSyncTask->sync_task_type_id . '" : "' . $nextSubSyncTask->sync_task_status_id . '"');

				if ($nextSubSyncTask->sync_task_status_id != 'Complete') {
					$this->info("\t" . 'Sync. sub-task not complete.');
					return false;
				}
			}
		}

		// Set this task to "InProgress" status
		$inProgressMainSyncTask->sync_task_status_id = 'Complete';
		$inProgressMainSyncTask->save();

		// Log
		$inProgressMainSyncTask->createLog('Sync. task complete', true);

		$this->info("\t" . 'Sync. task complete');

		return true;
	}

	/**
	 * Start/Manage all kind of sub-tasks
	 * @param string $subSyncTaskTypeId
	 */
	public function manageSubSyncTasks($subSyncTaskTypeId)
	{
		// Get the count of $subSyncTaskTypeId tasks "InProgress"
		$inProgressSubTasksCount = SyncTask::where('sync_task_type_id', $subSyncTaskTypeId)
											->where('sync_task_status_id', 'InProgress')
											->count();

		// Skip planned sub sync. task start if over the limit

		if ($inProgressSubTasksCount < config('app.syncTasksScheduling.maxInProgress.' . $subSyncTaskTypeId)) {

			// Get oldest sub sync. tasks planned, limited by the max allowed "InProgress" task at the same time
			$plannedSubSyncTasks = SyncTask::where('sync_task_type_id', $subSyncTaskTypeId)
											->where('sync_task_status_id', 'Planned')
											->take(config('app.syncTasksScheduling.maxInProgress.' . $subSyncTaskTypeId) - $inProgressSubTasksCount)
											->orderBy('created_at', 'ASC')
											->get();

			// Start the planned main sync. tasks
			foreach ($plannedSubSyncTasks as $plannedSubSyncTask) {
				$this->startPlannedSubSyncTask($subSyncTaskTypeId, $plannedSubSyncTask);
			}
		}
	}

	/**
	 * Manage a planned sub sync. task
	 *
	 * @param string $subSyncTaskTypeId Sync task type Id
	 * @param SyncTask $plannedSubSyncTask
	 * @throws \Exception
	 */
	private function startPlannedSubSyncTask($subSyncTaskTypeId, SyncTask $plannedSubSyncTask)
	{
		$this->info('Starting planned "' . $subSyncTaskTypeId . '" sync task [' . $plannedSubSyncTask->id . ']');

		$this->info("\t" . 'Updating status to "InProgress"');

		// Set this task to "InProgress" status
		$plannedSubSyncTask->sync_task_status_id = 'InProgress';
		$plannedSubSyncTask->save();

		// Log
		$plannedSubSyncTask->createLog('Sub sync. task started', true);

		switch ($subSyncTaskTypeId) {

			case 'DataStreamDownload' :

				// Local file name will be the "Main" sync. task ID
				$localFileName = $plannedSubSyncTask->sync_task_id;

				if (is_null($localFileName)) {
					// Log
					$plannedSubSyncTask->createLog('Planned "DataStreamDownload" sync. task does not have any parent sync. task', false);
					$this->error("\t" . 'Planned "DataStreamDownload" sync. task does not have any parent sync. task');
					throw new \Exception('Planned "DataStreamDownload" sync. task does not have any parent sync. task');
				}

				// Get the parent project data stream feed_url
				$feed_url = $plannedSubSyncTask->project()->first()->dataStream()->first()->feed_url;

				if (!$feed_url) {
					// Log
					$plannedSubSyncTask->createLog('Bad "feed_url" on parent project data stream.', false);
					$this->error("\t" . 'Bad "feed_url" on parent project data stream.');
					throw new \Exception('Bad "feed_url" on parent project data stream.');
				}

				// Log
				$plannedSubSyncTask->createLog('Downloading from ' . $feed_url, true);
				$this->info("\t" . 'Downloading from ' . $feed_url);

				// Download the data stream url file to local storage
				Storage::disk('syncTasksTempFolder')->put($localFileName, fopen($feed_url, 'r'));

				$file_size = Storage::disk('syncTasksTempFolder')->size($localFileName);

				// Log
				$plannedSubSyncTask->createLog('File saved : ' . $localFileName . ' (' . $file_size . ')', false);
				$this->info("\t" . 'File saved : ' . $localFileName . ' (' . $file_size . ')');

				// Set this task to "Complete" status
				$plannedSubSyncTask->sync_task_status_id = 'Complete';
				$plannedSubSyncTask->save();

				// Log
				$plannedSubSyncTask->createLog('Download complete', true);
				$this->info("\t" . 'Download complete');

				// Create next step sub-task : "DataStreamCheck"
				$plannedSubSyncTask->parentSyncTask()->first()->createSubTask('DataStreamCheck');

				break;

			case 'DataStreamCheck' :

				// Local file name is the "Main" sync. task ID
				$localFileName = $plannedSubSyncTask->sync_task_id;

				if (!Storage::disk('syncTasksTempFolder')->exists($localFileName)) {
					// Log
					$plannedSubSyncTask->createLog('Local file "' . $localFileName . '" not found', false);
					$this->error("\t" . 'Local file "' . $localFileName . '" not found');
					throw new \Exception('Local file "' . $localFileName . '" not found');
				}

				// Get the data stream

				/** @var DataStream $dataStream */
				$dataStream = $plannedSubSyncTask->project()->first()->dataStream()->first();

				// Get the data stream decoder

				/** @var DataStreamDecoder $dataStreamDecoder */
				$dataStreamDecoder = $dataStream->dataStreamDecoder()->first();

				// Check the decoder class

				$decoderClass = 'App\\DataStreamDecoders\\' . $dataStreamDecoder->class_name;

				if (!class_exists($decoderClass)) {
					// Log
					$plannedSubSyncTask->createLog('Decoder "' . $dataStreamDecoder->class_name . '" class not found in App\\DataStreamDecoders namespace', false);
					$this->error("\t" . 'Decoder "' . $dataStreamDecoder->class_name . '" class not found in App\\DataStreamDecoders namespace');
					throw new \Exception('Decoder "' . $dataStreamDecoder->class_name . '" class not found in App\\DataStreamDecoders namespace');
				}

				/** @var Decoder $decoder */
				$decoder = new $decoderClass;

				// Log
				$plannedSubSyncTask->createLog('Checking data from feed url downloaded file', true);
				$this->info("\t" . 'Checking data from feed url downloaded file');

				// Check the file content with the decoder class
				try {
					$decoder->check($localFileName, $dataStream);
				} catch (\Exception $e) {
					// Log
					$plannedSubSyncTask->createLog('Bad data provided from feed url', true);
					$this->error("\t" . 'Bad data provided from feed url');
					throw new $e;
				}

				// Set this task to "Complete" status
				$plannedSubSyncTask->sync_task_status_id = 'Complete';
				$plannedSubSyncTask->save();

				// Log
				$plannedSubSyncTask->createLog('File data successfully checked', true);
				$this->info("\t" . 'File data successfully checked');

				// Create next step sub-task : "DataStreamPrepare"
				$plannedSubSyncTask->parentSyncTask()->first()->createSubTask('DataStreamPrepare');

				break;

			case 'DataStreamPrepare' :

				// Local file name is the "Main" sync. task ID
				$localFileName = $plannedSubSyncTask->sync_task_id;

				if (!Storage::disk('syncTasksTempFolder')->exists($localFileName)) {
					// Log
					$plannedSubSyncTask->createLog('Local file "' . $localFileName . '" not found', false);
					$this->error("\t" . 'Local file "' . $localFileName . '" not found');
					throw new \Exception('Local file "' . $localFileName . '" not found');
				}

				// Get the project

				/** @var Project $project */
				$project = $plannedSubSyncTask->project()->first();
				
				// Get the data stream

				/** @var DataStream $dataStream */
				$dataStream = $project->dataStream()->first();

				// Get the data stream decoder

				/** @var DataStreamDecoder $dataStreamDecoder */
				$dataStreamDecoder = $dataStream->dataStreamDecoder()->first();

				// Check the decoder class

				$decoderClass = 'App\\DataStreamDecoders\\' . $dataStreamDecoder->class_name;

				if (!class_exists($decoderClass)) {
					// Log
					$plannedSubSyncTask->createLog('Decoder "' . $dataStreamDecoder->class_name . '" class not found in App\\DataStreamDecoders namespace', false);
					$this->error("\t" . 'Decoder "' . $dataStreamDecoder->class_name . '" class not found in App\\DataStreamDecoders namespace');
					throw new \Exception('Decoder "' . $dataStreamDecoder->class_name . '" class not found in App\\DataStreamDecoders namespace');
				}

				/** @var Decoder $decoder */
				$decoder = new $decoderClass;

				// Get the data stream project search engine model

				/** @var DataStreamDecoder $dataStreamDecoder */
				$searchEngineModel = $project->searchEngine()->first();

				// Check the search engine class

				$searchEngineClass = 'App\\SearchEngines\\' . $searchEngineModel->class_name;

				if (!class_exists($searchEngineClass)) {
					// Log
					$plannedSubSyncTask->createLog('Search Engine "' . $searchEngineModel->class_name . '" class not found in App\\SearchEngines namespace', false);
					$this->error("\t" . 'Search Engine "' . $searchEngineModel->class_name . '" class not found in App\\SearchEngines namespace');
					throw new \Exception('Search Engine "' . $searchEngineModel->class_name . '" class not found in App\\SearchEngines namespace');
				}

				/** @var SearchEngine $searchEngine */
				$searchEngine = new $searchEngineClass($project);

				// Get the parent main sync. task

				/** @var SyncTask $parentMainSyncTask */
				$parentMainSyncTask = $plannedSubSyncTask->parentSyncTask()->first();
				
				// Create next steps sub-tasks : "ItemsInsertion", "ItemsUpdate", "ItemsDelete" 
				
				$itemsInsertionSubSyncTask = $parentMainSyncTask->createSubTask('ItemsInsertion');

				// Log
				$plannedSubSyncTask->createLog('"ItemsInsertion" sub sync. task created [' . $itemsInsertionSubSyncTask->id . ']', false);
				$this->info("\t" . '"ItemsInsertion" sub sync. task created [' . $itemsInsertionSubSyncTask->id . ']');

				$itemsUpdateSubSyncTask = $parentMainSyncTask->createSubTask('ItemsUpdate');

				// Log
				$plannedSubSyncTask->createLog('"ItemsUpdate" sub sync. task created [' . $itemsUpdateSubSyncTask->id . ']', false);
				$this->info("\t" . '"ItemsUpdate" sub sync. task created [' . $itemsUpdateSubSyncTask->id . ']');

				$itemsDeleteSubSyncTask = $parentMainSyncTask->createSubTask('ItemsDelete');

				// Log
				$plannedSubSyncTask->createLog('"ItemsDelete" sub sync. task created [' . $itemsDeleteSubSyncTask->id . ']', false);
				$this->info("\t" . '"ItemsDelete" sub sync. task created [' . $itemsDeleteSubSyncTask->id . ']');
				
				// Log
				$plannedSubSyncTask->createLog('Decoding data from feed url downloaded file', true);
				$this->info("\t" . 'Decoding data from feed url downloaded file');

				// Decode and prepare
				$decoder->decodeAndPrepare($localFileName, $dataStream, $searchEngine,
										   $itemsInsertionSubSyncTask,
										   $itemsUpdateSubSyncTask,
										   $itemsDeleteSubSyncTask);

				// Delete sub-task if nothing to do
				// @todo @fixme decodeAndPrepare to fix, return collections of items to create/update/delete by ref instead ?

				if ($itemsInsertionSubSyncTask->syncTaskItems()->count() == 0) {
					// Log
					$plannedSubSyncTask->createLog('No items to insert, deleting the sub-task', false);
					$this->info("\t" . 'No items to insert, deleting the sub-task');

					$itemsInsertionSubSyncTask->delete();
				}

				if ($itemsUpdateSubSyncTask->syncTaskItems()->count() == 0) {
					// Log
					$plannedSubSyncTask->createLog('No items to update, deleting the sub-task', false);
					$this->info("\t" . 'No items to update, deleting the sub-task');

					$itemsUpdateSubSyncTask->delete();
				}

				if ($itemsDeleteSubSyncTask->syncTaskItems()->count() == 0) {
					// Log
					$plannedSubSyncTask->createLog('No items to delete, deleting the sub-task', false);
					$this->info("\t" . 'No items to delete, deleting the sub-task');

					$itemsDeleteSubSyncTask->delete();
				}

				// Set this task to "Complete" status
				$plannedSubSyncTask->sync_task_status_id = 'Complete';
				$plannedSubSyncTask->save();

				// Log
				$plannedSubSyncTask->createLog('Preparing data successfully complete', true);
				$this->info("\t" . 'Preparing data successfully complete');

				break;

			case 'ItemsInsertion' :

				// Get the project

				/** @var Project $project */
				$project = $plannedSubSyncTask->project()->first();

				// Get the data stream

				/** @var DataStream $dataStream */
				$dataStream = $project->dataStream()->first();

				// Log
				$plannedSubSyncTask->createLog('Getting the sync. sub-task items', false);
				$this->info("\t" . 'Getting the sync. sub-task items');

				$subSyncTaskItems = $plannedSubSyncTask->syncTaskItems()->get();

				// Get the data stream project search engine model

				/** @var DataStreamDecoder $dataStreamDecoder */
				$searchEngineModel = $project->searchEngine()->first();

				// Check the search engine class

				$searchEngineClass = 'App\\SearchEngines\\' . $searchEngineModel->class_name;

				if (!class_exists($searchEngineClass)) {
					// Log
					$plannedSubSyncTask->createLog('Search Engine "' . $searchEngineModel->class_name . '" class not found in App\\SearchEngines namespace', false);
					$this->error("\t" . 'Search Engine "' . $searchEngineModel->class_name . '" class not found in App\\SearchEngines namespace');
					throw new \Exception('Search Engine "' . $searchEngineModel->class_name . '" class not found in App\\SearchEngines namespace');
				}

				/** @var SearchEngine $searchEngine */
				$searchEngine = new $searchEngineClass($project);

				// Log
				$plannedSubSyncTask->createLog('Initializing Api Client "' . $searchEngineModel->name . '"', false);
				$this->info("\t" . 'Initializing Api Client (' . $searchEngineModel->name . ')');

				// Initialize client API
				$searchEngine->initClient();

				// Log
				$plannedSubSyncTask->createLog('Initializing project client container "' . $searchEngine->getClientContainerName() . '"', false);
				$this->info("\t" . 'Initializing project client container "' . $searchEngine->getClientContainerName() . '"');

				// Initialize client API project container
				$searchEngine->initProjectContainer();

				// Log
				$plannedSubSyncTask->createLog('Creating items in container "' . $searchEngine->getClientContainerName() . '" (' . $subSyncTaskItems->count() . ')', false);
				$this->info("\t" . 'Creating items in container "' . $searchEngine->getClientContainerName() . '" (' . $subSyncTaskItems->count() . ')');

				$searchEngine->createItems($subSyncTaskItems);

				// Delete sync. task items

				// Log
				$plannedSubSyncTask->createLog('Deleting sync. sub-task items', false);
				$this->info("\t" . 'Deleting sync. sub-task items');

				$plannedSubSyncTask->syncTaskItems()->delete();

				// Set this task to "Complete" status
				$plannedSubSyncTask->sync_task_status_id = 'Complete';
				$plannedSubSyncTask->save();

				// Log
				$plannedSubSyncTask->createLog('Inserting data successfully complete', true);
				$this->info("\t" . 'Inserting data successfully complete');

				break;

			case 'ItemsUpdate' :

				// Get the project

				/** @var Project $project */
				$project = $plannedSubSyncTask->project()->first();

				// Get the data stream

				/** @var DataStream $dataStream */
				$dataStream = $project->dataStream()->first();

				// Log
				$plannedSubSyncTask->createLog('Getting the sync. sub-task items', false);
				$this->info("\t" . 'Getting the sync. sub-task items');

				$subSyncTaskItems = $plannedSubSyncTask->syncTaskItems()->get();

				// Get the data stream project search engine model

				/** @var DataStreamDecoder $dataStreamDecoder */
				$searchEngineModel = $project->searchEngine()->first();

				// Check the search engine class

				$searchEngineClass = 'App\\SearchEngines\\' . $searchEngineModel->class_name;

				if (!class_exists($searchEngineClass)) {
					// Log
					$plannedSubSyncTask->createLog('Search Engine "' . $searchEngineModel->class_name . '" class not found in App\\SearchEngines namespace', false);
					$this->error("\t" . 'Search Engine "' . $searchEngineModel->class_name . '" class not found in App\\SearchEngines namespace');
					throw new \Exception('Search Engine "' . $searchEngineModel->class_name . '" class not found in App\\SearchEngines namespace');
				}

				/** @var SearchEngine $searchEngine */
				$searchEngine = new $searchEngineClass($project);

				// Log
				$plannedSubSyncTask->createLog('Initializing Api Client "' . $searchEngineModel->name . '"', false);
				$this->info("\t" . 'Initializing Api Client (' . $searchEngineModel->name . ')');

				// Initialize client API
				$searchEngine->initClient();

				// Log
				$plannedSubSyncTask->createLog('Initializing project client container "' . $searchEngine->getClientContainerName() . '"', false);
				$this->info("\t" . 'Initializing project client container "' . $searchEngine->getClientContainerName() . '"');

				// Initialize client API project container
				$searchEngine->initProjectContainer();

				// Log
				$plannedSubSyncTask->createLog('Updating items in container "' . $searchEngine->getClientContainerName() . '" (' . $subSyncTaskItems->count() . ')', false);
				$this->info("\t" . 'Updating items in container "' . $searchEngine->getClientContainerName() . '" (' . $subSyncTaskItems->count() . ')');

				$searchEngine->updateItems($subSyncTaskItems);

				// Delete sync. task items

				// Log
				$plannedSubSyncTask->createLog('Deleting sync. sub-task items', false);
				$this->info("\t" . 'Deleting sync. sub-task items');

				$plannedSubSyncTask->syncTaskItems()->delete();

				// Set this task to "Complete" status
				$plannedSubSyncTask->sync_task_status_id = 'Complete';
				$plannedSubSyncTask->save();

				// Log
				$plannedSubSyncTask->createLog('Updating data successfully complete', true);
				$this->info("\t" . 'Updating data successfully complete');

				break;

			case 'ItemsDelete' :

				// Get the project

				/** @var Project $project */
				$project = $plannedSubSyncTask->project()->first();

				// Get the data stream

				/** @var DataStream $dataStream */
				$dataStream = $project->dataStream()->first();

				// Log
				$plannedSubSyncTask->createLog('Getting the sync. sub-task items', false);
				$this->info("\t" . 'Getting the sync. sub-task items');

				$subSyncTaskItems = $plannedSubSyncTask->syncTaskItems()->get();

				// Get the data stream project search engine model

				/** @var DataStreamDecoder $dataStreamDecoder */
				$searchEngineModel = $project->searchEngine()->first();

				// Check the search engine class

				$searchEngineClass = 'App\\SearchEngines\\' . $searchEngineModel->class_name;

				if (!class_exists($searchEngineClass)) {
					// Log
					$plannedSubSyncTask->createLog('Search Engine "' . $searchEngineModel->class_name . '" class not found in App\\SearchEngines namespace', false);
					$this->error("\t" . 'Search Engine "' . $searchEngineModel->class_name . '" class not found in App\\SearchEngines namespace');
					throw new \Exception('Search Engine "' . $searchEngineModel->class_name . '" class not found in App\\SearchEngines namespace');
				}

				/** @var SearchEngine $searchEngine */
				$searchEngine = new $searchEngineClass($project);

				// Log
				$plannedSubSyncTask->createLog('Initializing Api Client "' . $searchEngineModel->name . '"', false);
				$this->info("\t" . 'Initializing Api Client (' . $searchEngineModel->name . ')');

				// Initialize client API
				$searchEngine->initClient();

				// Log
				$plannedSubSyncTask->createLog('Initializing project client container "' . $searchEngine->getClientContainerName() . '"', false);
				$this->info("\t" . 'Initializing project client container "' . $searchEngine->getClientContainerName() . '"');

				// Initialize client API project container
				$searchEngine->initProjectContainer();

				// Log
				$plannedSubSyncTask->createLog('Deleting items in container "' . $searchEngine->getClientContainerName() . '" (' . $subSyncTaskItems->count() . ')', false);
				$this->info("\t" . 'Deleting items in container "' . $searchEngine->getClientContainerName() . '" (' . $subSyncTaskItems->count() . ')');

				$searchEngine->deleteItems($subSyncTaskItems);

				// Delete sync. task items

				// Log
				$plannedSubSyncTask->createLog('Deleting sync. sub-task items', false);
				$this->info("\t" . 'Deleting sync. sub-task items');

				$plannedSubSyncTask->syncTaskItems()->delete();

				// Set this task to "Complete" status
				$plannedSubSyncTask->sync_task_status_id = 'Complete';
				$plannedSubSyncTask->save();

				// Log
				$plannedSubSyncTask->createLog('Deleting data successfully complete', true);
				$this->info("\t" . 'Deleting data successfully complete');

				break;

		}
	}
}
