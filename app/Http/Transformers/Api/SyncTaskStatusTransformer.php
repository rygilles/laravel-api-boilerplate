<?php

namespace App\Http\Transformers\Api;

use App\Models\SyncTaskStatus;

class SyncTaskStatusTransformer extends ApiTransformer
{
	/**
	 * Turn this item object into a generic array
	 *
	 * @param SyncTaskStatus $syncTaskStatus
	 * @return array
	 */
	public function transform(SyncTaskStatus $syncTaskStatus)
	{
		return $this->filterWithModelConfiguration(
			SyncTaskStatus::class,
			[
				'id' => $syncTaskStatus->id,
			]
		);
	}
}