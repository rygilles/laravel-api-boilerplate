<?php

namespace App\Http\Requests;

use App\Models\DataStreamField;

class UpdateDataStreamFieldRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		if ($this->isMethod('PATCH')) {
			return $this->filterWithModelConfiguration(DataStreamField::class, DataStreamField::getPatchRules());
		} elseif ($this->isMethod('PUT')) {
			return $this->filterWithModelConfiguration(DataStreamField::class, DataStreamField::getPutRules());
		} else {
			// @fixme Api documentation generator method "GET" for update... return PUT method rules
			return $this->filterWithModelConfiguration(DataStreamField::class, DataStreamField::getPutRules());
		}
	}
}
