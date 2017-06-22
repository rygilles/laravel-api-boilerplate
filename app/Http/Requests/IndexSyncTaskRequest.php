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
			'root' => 'boolean'
		];
	}
}
