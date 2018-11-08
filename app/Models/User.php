<?php

namespace App\Models;

use Alsofronie\Uuid\UuidModelTrait;
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
		'name',
		'email',
		'password',
		'preferred_language',
		'user_group_id',
		'confirmation_token',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
		'confirmation_token',
	];

	/**
	 * Model fillable fields for new items
	 * @var array
	 */
	protected static $storeFillable = [
		'id',
		'name',
		'email',
		'password',
		'preferred_language',
		'user_group_id'
	];

	/**
	 * Model fillable fields for item patch
	 * @var array
	 */
	protected static $patchFillable = [
		'name',
		'email',
		'password',
		'preferred_language',
		'user_group_id'
	];

	/**
	 * Model fillable fields for item replacement
	 * @var array
	 */
	protected static $putFillable = [
		'name',
		'email',
		'password',
		'preferred_language',
		'user_group_id'
	];

	/**
	 * Model validation rules for new items
	 * @var string[]
	 */
	protected static $storeRules = [
		'user_group_id'         => 'required|exists:user_group,id|in:Developer,Support,End-User',
		'name'                  => 'required|string|max:100',
		'email'                 => 'required|email|max:150|unique:user',
		'password'              => 'required|strength',
		'preferred_language'    => 'nullable|string|app_locale|max:30',
		'double_optin'          => 'required|boolean'
	];

	/**
	 * Model validation rules for item patch
	 * @var string[]
	 */
	protected static $patchRules = [
		'user_group_id'         => 'exists:user_group,id|in:Developer,Support,End-User',
		'name'                  => 'string|max:100',
		'email'                 => 'email|max:150', // 'unique:user' in controller method to manage "ignore" parameter.
		'password'              => 'strength',
		'preferred_language'    => 'nullable|string|app_locale|max:30'
	];

	/**
	 * Model validation rules for item replacement
	 * @var string[]
	 */
	protected static $putRules = [
		'user_group_id'         => 'required|exists:user_group,id|in:Developer,Support,End-User',
		'name'                  => 'required|string|max:100',
		'email'                 => 'required|email|max:150', // 'unique:user' in controller method to manage "ignore" parameter.
		'password'              => 'required|strength',
		'preferred_language'    => 'nullable|string|app_locale|max:30'
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
	 * Get the user group of this user
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function userGroup()
	{
		return $this->belongsTo(UserGroup::class);
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

	/**
	 * Check if this user is confirmed (email)
	 *
	 * @return bool
	 */
	public function isConfirmed()
	{
		return !is_null($this->confirmed_at);
	}
}
