<?php

namespace App\Http\Requests;

use App\Models\DataStreamPresetField;

class StoreDataStreamPresetFieldRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return $this->filterWithModelConfiguration(DataStreamPresetField::class, DataStreamPresetField::getStoreRules());
	}
}
