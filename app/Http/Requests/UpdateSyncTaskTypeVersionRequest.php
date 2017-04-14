<?php

namespace App\Http\Requests;

use App\Models\SyncTaskTypeVersion;

class UpdateSyncTaskTypeVersionRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		if ($this->isMethod('PATCH')) {
			return $this->filterWithModelConfiguration(SyncTaskTypeVersion::class, SyncTaskTypeVersion::getPatchRules());
		} elseif ($this->isMethod('PUT')) {
			return $this->filterWithModelConfiguration(SyncTaskTypeVersion::class, SyncTaskTypeVersion::getPutRules());
		} else {
			// @fixme Api documentation generator method "GET" for update... return PUT method rules
			return $this->filterWithModelConfiguration(SyncTaskTypeVersion::class, SyncTaskTypeVersion::getPutRules());
		}
	}
}
