<?php

namespace App\Http\Requests;

use App\Models\SyncTask;

class UpdateSyncTaskRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		if ($this->isMethod('PATCH')) {
			return $this->filterWithModelConfiguration(SyncTask::class, SyncTask::getPatchRules());
		} elseif ($this->isMethod('PUT')) {
			return $this->filterWithModelConfiguration(SyncTask::class, SyncTask::getPutRules());
		} else {
			// @fixme Api documentation generator method "GET" for update... return PUT method rules
			return $this->filterWithModelConfiguration(SyncTask::class, SyncTask::getPutRules());
		}
	}
}
