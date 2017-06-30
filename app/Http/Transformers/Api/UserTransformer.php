<?php

namespace App\Http\Transformers\Api;

use App\Models\User;

class UserTransformer extends ApiTransformer
{
	/**
	 * Turn this item object into a generic array
	 *
	 * @param User $user
	 * @return array
	 */
	public function transform(User $user)
	{
		return $this->filterWithModelConfiguration(
			User::class,
			[
				'id'            => $user->id,
				'user_group_id' => $user->user_group_id,
				'name'          => $user->name,
				'email'         => $user->email,
				'created_at'    => $user->created_at->toDateTimeString(),
				'updated_at'    => $user->updated_at->toDateTimeString()
			]
		);
	}
}