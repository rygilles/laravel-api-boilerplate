<?php

namespace App\Http\Transformers\Api;

use App\Models\UserGroup;

class UserGroupTransformer extends ApiTransformer
{
	/**
	 * Turn this item object into a generic array
	 *
	 * @param UserGroup $userGroup
	 * @return array
	 */
	public function transform(UserGroup $userGroup)
	{
		return $this->filterWithModelConfiguration(
			UserGroup::class,
			[
				'id'            => $userGroup->id,
			]
		);
	}
}