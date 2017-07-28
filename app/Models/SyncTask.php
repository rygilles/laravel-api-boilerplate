<?php

namespace App\Models;

use App\Models\Project;
use App\Models\SyncTaskLog;
use App\Models\SyncTaskStatus;
use App\Models\SyncTaskType;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'planned_at',
		'created_at',
		'updated_at',
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'sync_task_id',
		'sync_task_type_id',
		'sync_task_status_id',
		'project_id',
		'planned_at'
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
		'sync_task_id'          => 'uuid|exists:sync_task,id',
		'sync_task_type_id'     => 'required|string|max:50|exists:sync_task_type,id',
		'sync_task_status_id'   => 'required|string|max:50|exists:sync_task_status,id',
		'created_by_user_id'    => 'required|uuid|exists:user,id',
		'project_id'            => 'required|uuid|exists:project,id',
		'planned_at'            => 'date|after:now',
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
		'planned_at'            => 'date|after:now',
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
		'planned_at'            => 'date|after:now',
	];

	/**
	 * Get the parent sync task
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function parentSyncTask()
	{
		return $this->belongsTo(SyncTask::class, 'sync_task_id');
	}

	/**
	 * Get the children sync tasks
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\hasMany
	 */
	public function childrenSyncTasks()
	{
		return $this->hasMany(SyncTask::class, 'sync_task_id');
	}

	/**
	 * Get the sync task type
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function syncTaskType()
	{
		return $this->belongsTo(SyncTaskType::class);
	}

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
	 * Get the creator of this sync task
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function createdByUser()
	{
		return $this->belongsTo(User::class, 'created_by_user_id');
	}

	/**
	 * Get the parent project of this sync task
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function project()
	{
		return $this->belongsTo(Project::class);
	}

	/**
	 * Get the sync task logs
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\hasMany
	 */
	public function syncTaskLogs()
	{
		return $this->hasMany(SyncTaskLog::class);
	}

	/**
	 * Scope a query to include authorized access
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string[] $authorizedUserRolesIds User roles ids authorized to access to this route/resource
	 * @param string[] $exceptUserGroupsIds User groups ids authorized to access to this route
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeAuthorized($query, $authorizedUserRolesIds = ['Owner', 'Administrator'], $exceptUserGroupsIds = ['Developer', 'Support'])
	{
		// Apply query scope if user group id isn't authorized
		if (!in_array(Auth::user()->user_group_id, $exceptUserGroupsIds)) {
			return $query->whereHas('project', function ($query) use ($authorizedUserRolesIds) {
				$query->whereHas('hasUserProjects', function ($query) use ($authorizedUserRolesIds) {
					$query->where('user_id', Auth::user()->id)
						->whereIn('user_role_id', $authorizedUserRolesIds);
				});
			});
		}

		return $query;
	}

	/**
	 * Scope a query to filter parents only
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeParents($query)
	{
		return $query->whereNull('sync_task_id');
	}

	/**
	 * Scope a query to filter children only
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeChildren($query)
	{
		return $query->whereNotNull('sync_task_id');
	}

	/**
	 * Get the sync task items
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function syncTaskItems()
	{
		return $this->HasMany(SyncTaskItem::class);
	}

	/**
	 * Create a new log entry on this sync.task
	 *
	 * @param string $entry Message to log
	 * @param boolean $public Visibility
	 * @return SyncTaskLog
	 */
	public function createLog($entry, $public)
	{
		return SyncTaskLog::create([
			'sync_task_status_id'   => $this->sync_task_status_id,
			'sync_task_id'          => $this->id,
			'entry'                 => $entry,
			'public'                => $public,
		]);
	}

	/**
	 * Create a new sub task on this sync. task
	 *
	 * @param $sync_task_type_id
	 * @param string $sync_task_status_id
	 * @return SyncTask
	 */
	public function createSubTask($sync_task_type_id, $sync_task_status_id = 'Planned')
	{
		return SyncTask::create([
			'sync_task_id'          => $this->id,
			'sync_task_type_id'     => $sync_task_type_id,
			'sync_task_status_id'   => $sync_task_status_id,
			'project_id'            => $this->project_id,
		]);
	}
}