<?php

namespace App\Models;
use App\Models\SyncTask;
use App\Models\SyncTaskTypeVersion;

/**
 * Class SyncTaskType
 * @package App\Models
 */
class SyncTaskType extends ApiModel
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'sync_task_type';

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
		'id' => 'required|string|max:50|unique:sync_task_type,id',
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
	 * Get the sync task type versions
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function syncTaskTypeVersions()
	{
		return $this->HasMany(SyncTaskTypeVersion::class);
	}
}