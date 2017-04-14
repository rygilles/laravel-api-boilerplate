<?php

namespace App\Http\Requests;

use App\Models\SyncTaskStatusVersion;

class StoreSyncTaskStatusVersionRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return $this->filterWithModelConfiguration(SyncTaskStatusVersion::class, SyncTaskStatusVersion::getStoreRules());
	}
}
