<?php

namespace App\Http\Requests;

use App\Models\SearchUseCasePreset;

class UpdateSearchUseCasePresetRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		if ($this->isMethod('PATCH')) {
			return $this->filterWithModelConfiguration(SearchUseCasePreset::class, SearchUseCasePreset::getPatchRules());
		} elseif ($this->isMethod('PUT')) {
			return $this->filterWithModelConfiguration(SearchUseCasePreset::class, SearchUseCasePreset::getPutRules());
		} else {
			// @fixme Api documentation generator method "GET" for update... return PUT method rules
			return $this->filterWithModelConfiguration(SearchUseCasePreset::class, SearchUseCasePreset::getPutRules());
		}
	}
}
