<?php

namespace App\Models;

use App\Traits\HasCompositeKey;

/**
 * Class UserHasProject
 * @package App\Models
 */
class UserHasProject extends ApiModel
{
	use HasCompositeKey;

	/**
	 * The composite primary key for the model.
	 *
	 * @var string
	 */
	protected $primaryKey = ['user_id', 'project_id'];

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
	 * Model validation rules for new items
	 * @var string[]
	 */
	protected static $storeRules = [
		'user_id'       => 'required|uuid|exists:user,id|unique_with:user_has_project,project_id',
		'project_id'    => 'required|uuid|exists:project,id',
		'user_role_id'  => 'required|exists:user_role,id|in:Owner,Administrator',
	];

	/**
	 * Model validation rules for item patch
	 * @var string[]
	 */
	protected static $patchRules = [
		'user_id'       => 'uuid|exists:user,id|unique_with:user_has_project,project_id',
		'project_id'    => 'uuid|exists:project,id',
		'user_role_id'  => 'exists:user_role,id|in:Owner,Administrator',
	];

	/**
	 * Model validation rules for item replacement
	 * @var string[]
	 */
	protected static $putRules = [
		'user_id'       => 'required|uuid|exists:user,id|unique_with:user_has_project,project_id',
		'project_id'    => 'required|uuid|exists:project,id',
		'user_role_id'  => 'required|exists:user_role,id|in:Owner,Administrator',
	];

	/**
	 * Get the user of this relationship
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * Get the project of this relationship
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function project()
	{
		return $this->belongsTo(Project::class);
	}

	/**
	 * Get the user role of this relationship
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function userRole()
	{
		return $this->belongsTo(UserRole::class);
	}
}
