<?php

namespace App\Http\Requests;

use App\Models\DataStreamPreset;

class UpdateDataStreamPresetRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		if ($this->isMethod('PATCH')) {
			return $this->filterWithModelConfiguration(DataStreamPreset::class, DataStreamPreset::getPatchRules());
		} elseif ($this->isMethod('PUT')) {
			return $this->filterWithModelConfiguration(DataStreamPreset::class, DataStreamPreset::getPutRules());
		} else {
			// @fixme Api documentation generator method "GET" for update... return PUT method rules
			return $this->filterWithModelConfiguration(DataStreamPreset::class, DataStreamPreset::getPutRules());
		}
	}
}
