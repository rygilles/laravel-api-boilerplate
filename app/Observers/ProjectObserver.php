<?php

namespace App\Observers;

use App\Models\Project;
use App\Models\UserHasProject;
use Illuminate\Support\Facades\Auth;

class ProjectObserver
{
	/**
	 * Listen to the Project created event.
	 *
	 * @param  Project  $project
	 * @return void
	 */
	public function created(Project $project)
	{
		if (Auth::user()) {
			// Create user has project owner relationship
			$userHasProject = new UserHasProject();
			$userHasProject->user_id = Auth::user()->id;
			$userHasProject->project_id = $project->id;
			$userHasProject->user_role_id = 'Owner';
			$userHasProject->save();
		}
	}

	/**
	 * Listen to the Project deleting event.
	 *
	 * @param  Project  $project
	 * @return void
	 */
	public function deleting(Project $project)
	{
		// Delete user projects relationships
		foreach ($project->hasUserProjects() as $hasUserProject) {
			$hasUserProject->delete();
		}
	}
}