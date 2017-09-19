<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\UserCreatedNotification;
use Illuminate\Support\Facades\Notification;

class UserObserver
{
	/**
	 * Listen to the User created event.
	 *
	 * @param  User  $user
	 * @return void
	 */
	public function created(User $user)
	{
		// Notify developers

		Notification::send(User::all(), new UserCreatedNotification($user));
	}
}