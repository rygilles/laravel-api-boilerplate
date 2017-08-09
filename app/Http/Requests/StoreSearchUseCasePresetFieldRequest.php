<?php

namespace App\Http\Requests;

use App\Models\SearchUseCasePresetField;

class StoreSearchUseCasePresetFieldRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return $this->filterWithModelConfiguration(SearchUseCasePresetField::class, SearchUseCasePresetField::getStoreRules());
	}
}
