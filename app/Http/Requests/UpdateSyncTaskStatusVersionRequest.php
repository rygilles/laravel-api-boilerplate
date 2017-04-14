<?php

namespace App\Http\Requests;

use App\Models\SyncTaskStatusVersion;

class UpdateSyncTaskStatusVersionRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		if ($this->isMethod('PATCH')) {
			return $this->filterWithModelConfiguration(SyncTaskStatusVersion::class, SyncTaskStatusVersion::getPatchRules());
		} elseif ($this->isMethod('PUT')) {
			return $this->filterWithModelConfiguration(SyncTaskStatusVersion::class, SyncTaskStatusVersion::getPutRules());
		} else {
			// @fixme Api documentation generator method "GET" for update... return PUT method rules
			return $this->filterWithModelConfiguration(SyncTaskStatusVersion::class, SyncTaskStatusVersion::getPutRules());
		}
	}
}
