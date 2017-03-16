<?php

namespace App\Http\Transformers\Api;

use League\Fractal\TransformerAbstract;
use App\Models\User;

class UserTransformer extends TransformerAbstract
{
	/**
	 * Turn this item object into a generic array
	 *
	 * @param User $user
	 * @return array
	 */
	public function transform(User $user)
	{
		return [
			'id'            => $user->id,
			'name'          => $user->name,
			'email'         => $user->email,
			'created_at'    => $user->created_at->toDateTimeString(),
			'updated_at'    => $user->updated_at->toDateTimeString()
		];
	}
}