<?php

namespace App\Observers;

use App\Models\User;

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
		//
	}

	/**
	 * Listen to the User deleting event.
	 *
	 * @param  User  $user
	 * @return void
	 */
	public function deleting(User $user)
	{
		// Delete owned projects only
		foreach ($user->projects('Owner')->get() as $project) {
			echo('Deleting project "' . $project->name . '"' . "\r\n");

			$project->users()->detach();
			$project->delete();
		}

		$user->projects('Administrator')->detach();
	}
}