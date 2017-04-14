<?php

namespace App\Http\Requests;

use App\Models\SyncTaskTypeVersion;

class StoreSyncTaskTypeVersionRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return $this->filterWithModelConfiguration(SyncTaskTypeVersion::class, SyncTaskTypeVersion::getStoreRules());
	}
}
