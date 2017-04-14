<?php

namespace App\Http\Requests;

use App\Models\SyncTaskStatus;

class UpdateSyncTaskStatusRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		if ($this->isMethod('PATCH')) {
			return $this->filterWithModelConfiguration(SyncTaskStatus::class, SyncTaskStatus::getPatchRules());
		} elseif ($this->isMethod('PUT')) {
			return $this->filterWithModelConfiguration(SyncTaskStatus::class, SyncTaskStatus::getPutRules());
		} else {
			// @fixme Api documentation generator method "GET" for update... return PUT method rules
			return $this->filterWithModelConfiguration(SyncTaskStatus::class, SyncTaskStatus::getPutRules());
		}
	}
}
