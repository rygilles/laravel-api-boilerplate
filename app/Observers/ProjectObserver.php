<?php

namespace App\Observers;

use App\Models\Project;

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
		//
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