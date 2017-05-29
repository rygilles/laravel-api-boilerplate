<?php

namespace App\Http\Transformers\Api;

use App\Models\UserHasProject;

class UserHasProjectTransformer extends ApiTransformer
{
	/**
	 * Resources that can be included if requested.
	 *
	 * @var array
	 */
	protected $availableIncludes = [
		'user',
		'project'
	];

	/**
	 * Turn this item object into a generic array
	 *
	 * @param UserHasProject $userHasProject
	 * @return array
	 */
	public function transform(UserHasProject $userHasProject)
	{
		return $this->filterWithModelConfiguration(
			UserHasProject::class,
			[
				'user_id'       => $userHasProject->user_id,
				'project_id'    => $userHasProject->project_id,
				'user_role_id'  => $userHasProject->user_role_id,
				'created_at'    => $userHasProject->created_at->toDateTimeString(),
				'updated_at'    => $userHasProject->updated_at->toDateTimeString()
			]
		);
	}

	/**
	 * Include User
	 *
	 * @param UserHasProject $userHasProject
	 * @return League\Fractal\ItemResource
	 */
	public function includeUser(UserHasProject $userHasProject)
	{
		$user = $userHasProject->user;

		return $this->item($user, new UserTransformer);
	}

	/**
	 * Include Project
	 *
	 * @param UserHasProject $userHasProject
	 * @return League\Fractal\ItemResource
	 */
	public function includeProject(UserHasProject $userHasProject)
	{
		$project = $userHasProject->project;

		return $this->item($project, new ProjectTransformer);
	}
}