<?php

namespace App\Http\Requests;

use App\Models\SearchUseCase;

class UpdateSearchUseCaseRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		if ($this->isMethod('PATCH')) {
			return $this->filterWithModelConfiguration(SearchUseCase::class, SearchUseCase::getPatchRules());
		} elseif ($this->isMethod('PUT')) {
			return $this->filterWithModelConfiguration(SearchUseCase::class, SearchUseCase::getPutRules());
		} else {
			// @fixme Api documentation generator method "GET" for update... return PUT method rules
			return $this->filterWithModelConfiguration(SearchUseCase::class, SearchUseCase::getPutRules());
		}
	}
}
