<?php

namespace App\Observers;

use App\Models\UserHasProject;
use App\Notifications\AdministeredProject;
use Illuminate\Support\Facades\Auth;

class UserHasProjectObserver
{
	/**
	 * Listen to the User has project created event.
	 *
	 * @param  UserHasProject  $userHasProject
	 * @return void
	 */
	public function created(UserHasProject $userHasProject)
	{
		// Notify newly assigned administrator

		if ($userHasProject->user_role_id == 'Administrator') {
			$assignedByUser = Auth::user();
			if (!$assignedByUser) {
				// Get the project owner if there is no current user
				$assignedByUser = $userHasProject->project()->first()->users('Owner')->first();
			}
			$user = $userHasProject->user()->first();
			$project = $userHasProject->project()->first();
			$user->notify(new AdministeredProject($user, $project ,$assignedByUser));
		}
	}
}