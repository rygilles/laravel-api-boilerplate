<?php

namespace App\Http\Requests;

use App\Models\SearchUseCaseField;

class UpdateSearchUseCaseFieldRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		if ($this->isMethod('PATCH')) {
			return $this->filterWithModelConfiguration(SearchUseCaseField::class, SearchUseCaseField::getPatchRules());
		} elseif ($this->isMethod('PUT')) {
			return $this->filterWithModelConfiguration(SearchUseCaseField::class, SearchUseCaseField::getPutRules());
		} else {
			// @fixme Api documentation generator method "GET" for update... return PUT method rules
			return $this->filterWithModelConfiguration(SearchUseCaseField::class, SearchUseCaseField::getPutRules());
		}
	}
}
