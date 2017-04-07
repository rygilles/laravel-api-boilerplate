<?php

namespace App\Http\Requests;

use App\Models\DataStream;

class UpdateDataStreamRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		if ($this->isMethod('PATCH')) {
			return $this->filterWithModelConfiguration(DataStream::class, DataStream::getPatchRules());
		} elseif ($this->isMethod('PUT')) {
			return $this->filterWithModelConfiguration(DataStream::class, DataStream::getPutRules());
		} else {
			// @fixme Api documentation generator method "GET" for update... return PUT method rules
			return $this->filterWithModelConfiguration(DataStream::class, DataStream::getPutRules());
		}
	}
}
