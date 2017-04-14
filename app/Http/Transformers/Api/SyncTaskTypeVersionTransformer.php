<?php

namespace App\Http\Transformers\Api;

use App\Models\SyncTaskTypeVersion;

class SyncTaskTypeVersionTransformer extends ApiTransformer
{
	/**
	 * Turn this item object into a generic array
	 *
	 * @param SyncTaskTypeVersion $syncTaskTypeVersion
	 * @return array
	 */
	public function transform(SyncTaskTypeVersion $syncTaskTypeVersion)
	{
		return $this->filterWithModelConfiguration(
			SyncTaskTypeVersion::class,
			[
				'sync_task_type_id' => $syncTaskTypeVersion->sync_task_type_id,
				'i18n_lang_id'      => $syncTaskTypeVersion->i18n_lang_id,
				'description'       => $syncTaskTypeVersion->description,
				'created_at'        => $syncTaskTypeVersion->created_at->toDateTimeString(),
				'updated_at'        => $syncTaskTypeVersion->updated_at->toDateTimeString()
			]
		);
	}
}