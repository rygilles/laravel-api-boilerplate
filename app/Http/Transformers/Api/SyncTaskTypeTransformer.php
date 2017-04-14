<?php

namespace App\Http\Transformers\Api;

use App\Models\SyncTaskType;

class SyncTaskTypeTransformer extends ApiTransformer
{
	/**
	 * Turn this item object into a generic array
	 *
	 * @param SyncTaskType $syncTaskType
	 * @return array
	 */
	public function transform(SyncTaskType $syncTaskType)
	{
		return $this->filterWithModelConfiguration(
			SyncTaskType::class,
			[
				'id' => $syncTaskType->id,
			]
		);
	}
}