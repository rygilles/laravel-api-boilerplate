<?php

namespace App\Models;

use Alsofronie\Uuid\UuidModelTrait;

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
	 * @var array
	 */
	protected static $storeRules = [
		'search_engine_id'  => 'required|exists:search_engine,id',
		'data_stream_id'    => 'exists:data_stream,id',
		'name'              => 'required|string|max:100'
	];

	/**
	 * Model validation rules for item patch
	 * @var array
	 */
	protected static $patchRules = [
		'search_engine_id'  => 'required|exists:search_engine,id',
		'data_stream_id'    => 'exists:data_stream,id',
		'name'              => 'required|string|max:100'
	];

	/**
	 * Model validation rules for item replacement
	 * @var array
	 */
	protected static $putRules = [
		'search_engine_id'  => 'required|exists:search_engine,id',
		'data_stream_id'    => 'exists:data_stream,id',
		'name'              => 'required|string|max:100'
	];

	/**
	 * Get model validation rules for new items
	 * @return array
	 */
	public static function getStoreRules()
	{
		return self::$storeRules;
	}

	/**
	 * Get model validation rules for item patch
	 * @return array
	 */
	public static function getPatchRules()
	{
		return self::$patchRules;
	}

	/**
	 * Get model validation rules for item replacement
	 * @return array
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
}
