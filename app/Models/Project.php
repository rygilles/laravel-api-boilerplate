<?php

namespace App\Models;

use Alsofronie\Uuid\UuidModelTrait;

use Dingo\Api\Facade\Route;
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
	 * Default pagination limit
	 * @var int
	 */
	protected $perPage = 20;

	/**
	 * Pagination limit inclusive min value
	 * @var int
	 */
	protected $perPageMin = 1;

	/**
	 * Pagination limit inclusive max value
	 * @var int
	 */
	protected $perPageMax = 50;

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
	 * Model default validation rules
	 * @return string[]
	 */
	public function rules()
	{
		return self::getStoreRules();
	}

	/**
	 * Get model validation rules for new items
	 * @return string[]
	 */
	public static function getStoreRules()
	{
		return self::$storeRules;
	}

	/**
	 * Get model validation rules for item patch
	 * @return string[]
	 */
	public static function getPatchRules()
	{
		return self::$patchRules;
	}

	/**
	 * Get model validation rules for item replacement
	 * @return string[]
	 */
	public static function getPutRules()
	{
		return self::$putRules;
	}

	/**
	 * Get the relationships between this project and his users
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function hasUserProjects()
	{
		return $this->hasMany('App\Models\UserHasProject');
	}

	/**
	 * Get the users of this project using relationship table
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function users()
	{
		return $this->belongsToMany('App\Models\User', 'user_has_project', 'project_id', 'user_id');
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
