<?php

namespace App\Models;
use Alsofronie\Uuid\UuidModelTrait;

/**
 * Class SyncTask
 * @package App\Models
 */
class SyncTask extends ApiModel
{
	use UuidModelTrait;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'sync_task';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'sync_task_id',
		'sync_task_type_id',
		'sync_task_status_id',
		'project_id'
	];

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = true;

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
		'sync_task_id'          => 'uuid|exists:sync_task,id',
		'sync_task_type_id'     => 'required|string|max:50|exists:sync_task_type,id',
		'sync_task_status_id'   => 'required|string|max:50|exists:sync_task_status,id',
		'created_by_user_id'    => 'required|uuid|exists:user,id',
		'project_id'            => 'required|uuid|exists:project,id',
	];

	/**
	 * Model validation rules for item patch
	 * @var string[]
	 */
	protected static $patchRules = [
		'sync_task_id'          => 'uuid|exists:sync_task,id',
		'sync_task_type_id'     => 'string|max:50|exists:sync_task_type,id',
		'sync_task_status_id'   => 'string|max:50|exists:sync_task_status,id',
		'created_by_user_id'    => 'uuid|exists:user,id',
		'project_id'            => 'uuid|exists:project,id',
	];

	/**
	 * Model validation rules for item replacement
	 * @var string[]
	 */
	protected static $putRules = [
		'sync_task_id'          => 'uuid|exists:sync_task,id',
		'sync_task_type_id'     => 'required|string|max:50|exists:sync_task_type,id',
		'sync_task_status_id'   => 'required|string|max:50|exists:sync_task_status,id',
		'created_by_user_id'    => 'required|uuid|exists:user,id',
		'project_id'            => 'required|uuid|exists:project,id',
	];

	/**
	 * Get the parent sync task
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function parentSyncTask()
	{
		return $this->belongsTo('App\Models\SyncTask', 'sync_task_id');
	}

	/**
	 * Get the children sync tasks
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\hasMany
	 */
	public function childrenSyncTask()
	{
		return $this->hasMany('App\Models\SyncTask', 'sync_task_id');
	}

	/**
	 * Get the sync task type
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function syncTaskType()
	{
		return $this->belongsTo('App\Models\SyncTaskType');
	}

	/**
	 * Get the sync task status
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function syncTaskStatus()
	{
		return $this->belongsTo('App\Models\SyncTaskStatus');
	}

	/**
	 * Get the creator of this sync task
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function createdByUser()
	{
		return $this->belongsTo('App\Models\User', 'created_by_user_id');
	}

	/**
	 * Get the parent project of this sync task
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function project()
	{
		return $this->belongsTo('App\Models\Project');
	}
}