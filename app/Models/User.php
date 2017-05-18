<?php

namespace App\Models;

use Alsofronie\Uuid\UuidModelTrait;
use App\Models\Project;
use App\Models\SyncTasks;
use App\Models\UserGroup;
use App\Models\UserHasProject;
use Illuminate\Notifications\Notifiable;

use Illuminate\Notifications\RoutesNotifications;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Broadcasting\PrivateChannel;

use App\Auth\Notifications\ResetPassword as ResetPasswordNotification;

class User extends ApiModel implements AuthenticatableContract,	AuthorizableContract, CanResetPasswordContract
{
	use HasApiTokens;
	use Authenticatable, Authorizable, CanResetPassword;
	use RoutesNotifications;
	use UuidModelTrait;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'user';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'user_group_id'
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
	 * Model validation rules for new items
	 * @var string[]
	 */
	protected static $storeRules = [
		'user_group_id' => 'required|exists:user_group,id|in:Developer,Support,End-User',
		'name'          => 'required|string|max:100',
		'email'         => 'required|email|max:150|unique:user',
		'password'      => 'required|strength'
	];

	/**
	 * Model validation rules for item patch
	 * @var string[]
	 */
	protected static $patchRules = [
		'user_group_id' => 'exists:user_group,id|in:Developer,Support,End-User',
		'name'          => 'string|max:100',
		'email'         => 'email|max:150|unique:user',
		'password'      => 'strength'
	];

	/**
	 * Model validation rules for item replacement
	 * @var string[]
	 */
	protected static $putRules = [
		'user_group_id' => 'required|exists:user_group,id|in:Developer,Support,End-User',
		'name'          => 'required|string|max:100',
		'email'         => 'required|email|max:150|unique:user',
		'password'      => 'required|strength'
	];

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
		return $this->hasMany(UserHasProject::class);
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
			return $this->belongsToMany(Project::class, 'user_has_project', 'user_id', 'project_id')->wherePivot('user_role_id', $user_role_id);
		else
			return $this->belongsToMany(Project::class, 'user_has_project', 'user_id', 'project_id');
	}

	/**
	 * Get the project of this user using relationship table
	 *
	 * @param   string  $project_id Project ID
	 * @return Project
	 */
	public function project($project_id)
	{
		return $this->belongsToMany(Project::class, 'user_has_project', 'user_id', 'project_id')->wherePivot('project_id', $project_id)->first();
	}

	/**
	 * Get the user group of this user
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function userGroup()
	{
		return $this->belongsTo(UserGroup::class);
	}

	/**
	 * Get the sync task created bu this user
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function createdSyncTasks()
	{
		return $this->hasMany(SyncTask::class, 'created_by_user_id');
	}

	/**
	 * Get the entity's notifications.
	 */
	public function notifications()
	{
		return $this->morphMany(Notification::class, 'notifiable')
			->orderBy('created_at', 'desc');
	}

	/**
	 * Get the entity's read notifications.
	 */
	public function readNotifications()
	{
		return $this->notifications()
			->whereNotNull('read_at');
	}

	/**
	 * Get the entity's unread notifications.
	 */
	public function unreadNotifications()
	{
		return $this->notifications()
			->whereNull('read_at');
	}
}
