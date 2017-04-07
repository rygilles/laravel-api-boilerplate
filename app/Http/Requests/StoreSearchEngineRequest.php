<?php

namespace App\Http\Requests;

use App\Models\SearchEngine;

class StoreSearchEngineRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return $this->filterWithModelConfiguration(SearchEngine::class, SearchEngine::getStoreRules());
	}
}
