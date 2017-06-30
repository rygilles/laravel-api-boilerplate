<?php

namespace App\Http\Requests;

use App\Models\DataStreamPreset;

class StoreDataStreamPresetRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return $this->filterWithModelConfiguration(DataStreamPreset::class, DataStreamPreset::getStoreRules());
	}
}
