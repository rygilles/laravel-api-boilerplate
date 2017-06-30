<?php

namespace App\Http\Requests;

use App\Models\DataStreamPresetField;

class UpdateDataStreamPresetFieldRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		if ($this->isMethod('PATCH')) {
			return $this->filterWithModelConfiguration(DataStreamPresetField::class, DataStreamPresetField::getPatchRules());
		} elseif ($this->isMethod('PUT')) {
			return $this->filterWithModelConfiguration(DataStreamPresetField::class, DataStreamPresetField::getPutRules());
		} else {
			// @fixme Api documentation generator method "GET" for update... return PUT method rules
			return $this->filterWithModelConfiguration(DataStreamPresetField::class, DataStreamPresetField::getPutRules());
		}
	}
}
