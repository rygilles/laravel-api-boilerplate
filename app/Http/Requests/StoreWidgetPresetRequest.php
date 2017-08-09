<?php

namespace App\Http\Requests;

use App\Models\WidgetPreset;

class StoreWidgetPresetRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return $this->filterWithModelConfiguration(WidgetPreset::class, WidgetPreset::getStoreRules());
	}
}
