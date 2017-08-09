<?php

namespace App\Http\Requests;

use App\Models\SearchUseCasePreset;

class StoreSearchUseCasePresetRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return $this->filterWithModelConfiguration(SearchUseCasePreset::class, SearchUseCasePreset::getStoreRules());
	}
}
