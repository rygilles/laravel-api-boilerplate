<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest;
use App\Models\DataStream;

class UpdateDataStreamRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		if ($this->isMethod('PATCH')) {
			return DataStream::getPatchRules();
		} elseif ($this->isMethod('PUT')) {
			return DataStream::getPutRules();
		} else {
			// @fixme Api documentation generator method "GET" for update... return PUT method rules
			return DataStream::getPutRules();
		}
	}
}
