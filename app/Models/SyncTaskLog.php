<?php

namespace App\Models;
use Alsofronie\Uuid\UuidModelTrait;
use App\Models\SyncTask;
use App\Models\SyncTaskStatus;

/**
 * Class SyncTaskLog
 * @package App\Models
 */
class SyncTaskLog extends ApiModel
{
	use UuidModelTrait;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'sync_task_log';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'sync_task_status_id',
		'sync_task_id',
		'entry',
		'public'
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
	 * @var string[]
	 */
	protected static $storeRules = [
		'sync_task_status_id'   => 'required|string|max:50|exists:sync_task_status,id',
		'sync_task_id'          => 'required|uuid|exists:sync_task,id',
		'entry'                 => 'required|string',
		'public'                => 'required|boolean',
	];

	/**
	 * Model validation rules for item patch
	 * @var string[]
	 */
	protected static $patchRules = [
		'sync_task_status_id'   => 'string|max:50|exists:sync_task_status,id',
		'sync_task_id'          => 'uuid|exists:sync_task,id',
		'entry'                 => 'string',
		'public'                => 'boolean',
	];

	/**
	 * Model validation rules for item replacement
	 * @var string[]
	 */
	protected static $putRules = [
		'sync_task_status_id'   => 'required|string|max:50|exists:sync_task_status,id',
		'sync_task_id'          => 'required|uuid|exists:sync_task,id',
		'entry'                 => 'required|string',
		'public'                => 'required|boolean',
	];

	/**
	 * Get the sync task status
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function syncTaskStatus()
	{
		return $this->belongsTo(SyncTaskStatus::class);
	}

	/**
	 * Get the sync task
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function syncTask()
	{
		return $this->belongsTo(SyncTask::class);
	}

	/**
	 * Scope a query to filter public access
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopePublic($query)
	{
		return $query->where('public', true);
	}

	/**
	 * Scope a query to filter private access
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopePrivate($query)
	{
		return $query->where('public', false);
	}
}