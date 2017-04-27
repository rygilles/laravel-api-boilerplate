<?php

namespace App\Http\Requests;

class IndexMeNotificationRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'read_status' => 'in:read,unread'
		];
	}
}
