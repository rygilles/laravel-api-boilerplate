<?php

namespace App\Http\Requests;

use App\Models\SyncTaskStatus;

class StoreSyncTaskStatusRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return $this->filterWithModelConfiguration(SyncTaskStatus::class, SyncTaskStatus::getStoreRules());
	}
}
