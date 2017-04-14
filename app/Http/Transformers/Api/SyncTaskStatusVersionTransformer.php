<?php

namespace App\Http\Transformers\Api;

use App\Models\SyncTaskStatusVersion;

class SyncTaskStatusVersionTransformer extends ApiTransformer
{
	/**
	 * Turn this item object into a generic array
	 *
	 * @param SyncTaskStatusVersion $syncTaskStatusVersion
	 * @return array
	 */
	public function transform(SyncTaskStatusVersion $syncTaskStatusVersion)
	{
		return $this->filterWithModelConfiguration(
			SyncTaskStatusVersion::class,
			[
				'sync_task_type_id' => $syncTaskStatusVersion->sync_task_status_id,
				'i18n_lang_id'      => $syncTaskStatusVersion->i18n_lang_id,
				'description'       => $syncTaskStatusVersion->description,
				'created_at'        => $syncTaskStatusVersion->created_at->toDateTimeString(),
				'updated_at'        => $syncTaskStatusVersion->updated_at->toDateTimeString()
			]
		);
	}
}