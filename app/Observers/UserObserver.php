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
		echo('deleting user "' . $user->name . '"' . "\n");

		// Set related sync tasks user foreign key to NULL (for user projects only)
		foreach ($user->projects()->get() as $project) {
			echo('project "' . $project->name . '" has ' . count($project->syncTasks()) . ' sync tasks' . "\n");
			foreach ($project->syncTasks() as $syncTask) {
				echo('project "' . $project->name . '" dissociate sync task' . "\n");
				$syncTask->dissociate();
				$syncTask->save();
			}
		}

		// Delete owned projects only
		foreach ($user->projects('Owner')->get() as $project) {
			// Remove relation between the user and his projects
			$project->users()->detach();

			$project->delete();
		}

		$user->projects('Administrator')->detach();
	}
}