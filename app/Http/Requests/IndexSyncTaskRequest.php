<?php

namespace App\Http\Requests;

class IndexSyncTaskRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'root'                  => 'boolean',
			'sync_task_status_id'   => 'exists:sync_task_status,id|in:Planned,InProgress,Complete',
			'planned_before'        => 'date',
			'planned_after'         => 'date',
		];
	}
}
