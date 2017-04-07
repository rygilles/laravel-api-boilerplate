<?php

namespace App\Http\Requests;

use App\Models\SearchEngine;

class UpdateSearchEngineRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		if ($this->isMethod('PATCH')) {
			return $this->filterWithModelConfiguration(SearchEngine::class, SearchEngine::getPatchRules());
		} elseif ($this->isMethod('PUT')) {
			return $this->filterWithModelConfiguration(SearchEngine::class, SearchEngine::getPutRules());
		} else {
			// @fixme Api documentation generator method "GET" for update... return PUT method rules
			return $this->filterWithModelConfiguration(SearchEngine::class, SearchEngine::getPutRules());
		}
	}
}
