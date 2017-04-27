<?php

namespace App\Models;
use App\Models\SyncTask;
use App\Models\SyncTaskLog;
use App\Models\SyncTaskStatusVersion;

/**
 * Class SyncTaskStatus
 * @package App\Models
 */
class SyncTaskStatus extends ApiModel
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'sync_task_status';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id'
	];

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * Indicates if the IDs are auto-incrementing.
	 *
	 * @var bool
	 */
	public $incrementing = false;

	/**
	 * Model validation rules for new items
	 * @var array
	 */
	protected static $storeRules = [
		'id' => 'required|string|max:50|unique:sync_task_status,id',
	];

	/**
	 * Get the sync tasks
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function syncTasks()
	{
		return $this->HasMany(SyncTask::class);
	}

	/**
	 * Get the sync task status logs
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function syncTaskLogs()
	{
		return $this->HasMany(SyncTaskLog::class);
	}

	/**
	 * Get the sync task status versions
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function syncTaskStatusVersions()
	{
		return $this->HasMany(SyncTaskStatusVersion::class);
	}
}