<?php

namespace App\Models;
use App\Models\UserHasProject;

/**
 * Class UserRole
 * @package App\Models
 */
class UserRole extends ApiModel
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'user_role';

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
		'id' => 'required|string|max:30|unique:user_role,id',
	];

	/**
	 * Get the relationships between this user role and his projects
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function hasUserProjects()
	{
		return $this->hasMany(UserHasProject::class);
	}
}