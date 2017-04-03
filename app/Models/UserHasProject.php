<?php

namespace App\Models;

/**
 * Class UserHasProject
 * @package App\Models
 */
class UserHasProject extends ApiModel
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'user_has_project';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'project_id',
		'user_role_id'
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
		'user_id'       => 'required|uuid|exists:user,id',
		'project_id'    => 'required|uuid|exists:project,id',
		'user_role_id'  => 'required|exists:user_role,id|in:Owner,Administrator',
	];

	/**
	 * Model validation rules for item patch
	 * @var string[]
	 */
	protected static $patchRules = [
		'user_id'       => 'uuid|exists:user,id',
		'project_id'    => 'uuid|exists:project,id',
		'user_role_id'  => 'exists:user_role,id|in:Owner,Administrator',
	];

	/**
	 * Model validation rules for item replacement
	 * @var string[]
	 */
	protected static $putRules = [
		'user_id'       => 'required|uuid|exists:user,id',
		'project_id'    => 'required|uuid|exists:project,id',
		'user_role_id'  => 'required|exists:user_role,id|in:Owner,Administrator',
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
	 * Get the user of this relationship
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

	/**
	 * Get the project of this relationship
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function project()
	{
		return $this->belongsTo('App\Models\Project');
	}

	/**
	 * Get the user role of this relationship
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function userRole()
	{
		return $this->belongsTo('App\Models\UserRole');
	}
}
