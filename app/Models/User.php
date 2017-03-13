<?php

namespace App\Models;

use Alsofronie\Uuid\UuidModelTrait;
use Illuminate\Notifications\Notifiable;

use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use App\Auth\Notifications\ResetPassword as ResetPasswordNotification;

class User extends ApiModel implements AuthenticatableContract,	AuthorizableContract, CanResetPasswordContract
{
	use HasApiTokens;
	use Authenticatable, Authorizable, CanResetPassword;
	use Notifiable;
	use UuidModelTrait;

	/**
	 * The table associated with the model.
	 * .
	 * @var string
	 */
	protected $table = 'user';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

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
	 * Model validation rules
	 *
	 * Passwords need one uppercase/lowercase and one number at least (RegEx)
	 *
	 * @var array
	 */
	protected static $rules = [
		'name'      => 'required|string|max:255',
		'email'     => 'required|email|max:255|unique:user',
		'password'  => 'required|min:6|uppercase_min:1|lowercase_min:1|numeric_min:1'
	];

	/**
	 * Get model  validation rules
	 *
	 * @return array
	 */
	public static function getRules()
	{
		return self::$rules;
	}

	/**
	 * Magic attribute setter : Define password hashed value
	 *
	 * @param string $password
	 */
	public function setPasswordAttribute($password)
	{
		$this->attributes['password'] = Hash::make($password);
	}

	/**
	 * Send the password reset notification.
	 *
	 * @param  string  $token
	 * @return void
	 */
	public function sendPasswordResetNotification($token)
	{
		$this->notify(new ResetPasswordNotification($token));
	}

	/**
	 * Get the relationships between this user and his projects
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function hasUserProjects()
	{
		return $this->hasMany('App\Models\UserHasProject');
	}

	/**
	 * Get the projects of this user using relationship table
	 *
	 * @param   string  $user_role_id   Pivot user role id
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function projects($user_role_id = null)
	{
		if (!is_null($user_role_id))
			return $this->belongsToMany('App\Models\Project', 'user_has_project', 'user_id', 'project_id')->wherePivot('user_role_id', $user_role_id);
		else
			return $this->belongsToMany('App\Models\Project', 'user_has_project', 'user_id', 'project_id');
	}

	/**
	 * Get the project of this user using relationship table
	 *
	 * @param   string  $project_id Project ID
	 * @return \App\Models\Project
	 */
	public function project($project_id)
	{
		return $this->belongsToMany('App\Models\Project', 'user_has_project', 'user_id', 'project_id')->wherePivot('project_id', $project_id)->first();
	}
}
