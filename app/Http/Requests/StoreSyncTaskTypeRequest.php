<?php

namespace App\Http\Requests;

use App\Models\SyncTaskType;

class StoreSyncTaskTypeRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return $this->filterWithModelConfiguration(SyncTaskType::class, SyncTaskType::getStoreRules());
	}
}
