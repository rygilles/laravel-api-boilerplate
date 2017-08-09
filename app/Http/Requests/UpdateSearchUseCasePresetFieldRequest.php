<?php

namespace App\Http\Requests;

use App\Models\SearchUseCasePresetField;

class UpdateSearchUseCasePresetFieldRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		if ($this->isMethod('PATCH')) {
			return $this->filterWithModelConfiguration(SearchUseCasePresetField::class, SearchUseCasePresetField::getPatchRules());
		} elseif ($this->isMethod('PUT')) {
			return $this->filterWithModelConfiguration(SearchUseCasePresetField::class, SearchUseCasePresetField::getPutRules());
		} else {
			// @fixme Api documentation generator method "GET" for update... return PUT method rules
			return $this->filterWithModelConfiguration(SearchUseCasePresetField::class, SearchUseCasePresetField::getPutRules());
		}
	}
}
