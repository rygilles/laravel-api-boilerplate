<?php

namespace App\Http\Transformers\Api;

use League\Fractal\TransformerAbstract;
use App\Models\UserHasProject;

class UserHasProjectTransformer extends ApiTransformer
{
	/**
	 * Turn this item object into a generic array
	 *
	 * @param UserHasProject $userHasProject
	 * @return array
	 */
	public function transform(UserHasProject $userHasProject)
	{
		return $this->filterWithModelConfiguration(
			SearchEngine::class,
			[
				'user_id'       => $userHasProject->user_id,
				'project_id'    => $userHasProject->project_id,
				'user_role_id'  => $userHasProject->user_role_id,
				'created_at'    => $userHasProject->created_at->toDateTimeString(),
				'updated_at'    => $userHasProject->updated_at->toDateTimeString()
			]
		);
	}
}