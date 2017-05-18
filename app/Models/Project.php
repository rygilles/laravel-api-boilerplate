<?php

namespace App\Models;

use Alsofronie\Uuid\UuidModelTrait;
use App\Models\DataStream;
use App\Models\SyncItem;
use App\Models\SyncTask;
use App\Models\User;
use App\Models\UserHasProject;
use Illuminate\Support\Facades\Auth;

/**
 * Class Project
 * @package App\Models
 */
class Project extends ApiModel
{
	use UuidModelTrait;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'project';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'search_engine_id',
		'data_stream_id',
		'name'
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
	 * Pagination limit inclusive max value
	 * @var int
	 */
	protected $perPageMax = 50;

	/**
	 * Model fillable fields for new items
	 * @var array
	 */
	protected static $storeFillable = [
		'search_engine_id',
		'data_stream_id',
		'name'
	];

	/**
	 * Model fillable fields for item patch
	 * @var array
	 */
	protected static $patchFillable = [
		'search_engine_id',
		'data_stream_id',
		'name'
	];

	/**
	 * Model fillable fields for item replacement
	 * @var array
	 */
	protected static $putFillable = [
		'search_engine_id',
		'data_stream_id',
		'name'
	];

	/**
	 * Model validation rules for new items
	 * @var string[]
	 */
	protected static $storeRules = [
		'search_engine_id'  => 'required|uuid|exists:search_engine,id',
		'data_stream_id'    => 'uuid|exists:data_stream,id',
		'name'              => 'required|string|min:5|max:100'
	];

	/**
	 * Model validation rules for item patch
	 * @var string[]
	 */
	protected static $patchRules = [
		'search_engine_id'  => 'uuid|exists:search_engine,id',
		'data_stream_id'    => 'uuid|exists:data_stream,id',
		'name'              => 'string|min:5|max:100'
	];

	/**
	 * Model validation rules for item replacement
	 * @var string[]
	 */
	protected static $putRules = [
		'search_engine_id'  => 'required|uuid|exists:search_engine,id',
		'data_stream_id'    => 'uuid|exists:data_stream,id',
		'name'              => 'required|string|min:5|max:100'
	];

	/**
	 * Get the search engine of this project
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function searchEngine()
	{
		return $this->belongsTo(SearchEngine::class);
	}

	/**
	 * Get the relationships between this project and his users
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function hasUserProjects()
	{
		return $this->hasMany(UserHasProject::class);
	}

	/**
	 * Get the users of this project using relationship table
	 *
	 * @param   string  $user_role_id   Pivot user role id
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function users($user_role_id = null)
	{
		if (!is_null($user_role_id))
			return $this->belongsToMany(User::class, 'user_has_project', 'project_id', 'user_id')->wherePivot('user_role_id', $user_role_id);
		else
			return $this->belongsToMany(User::class, 'user_has_project', 'project_id', 'user_id');
	}

	/**
	 * Get the data stream of this project
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function dataStream()
	{
		return $this->belongsTo(DataStream::class);
	}

	/**
	 * Get the sync items
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function syncItems()
	{
		return $this->HasMany(SyncItem::class);
	}

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
			return $query->whereHas('hasUserProjects', function ($query) use ($authorizedUserRolesIds) {
				$query->where('user_id', Auth::user()->id)
					->whereIn('user_role_id', $authorizedUserRolesIds);
			});
		}

		return $query;
	}

}
