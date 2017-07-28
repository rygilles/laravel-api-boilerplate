<?php

namespace App\Http\Requests;

use App\Models\SearchUseCaseField;

class StoreSearchUseCaseFieldRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return $this->filterWithModelConfiguration(SearchUseCaseField::class, SearchUseCaseField::getStoreRules());
	}
}
