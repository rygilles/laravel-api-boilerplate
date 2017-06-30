<?php

namespace App\Http\Requests;

use App\Models\DataStreamField;

class StoreDataStreamFieldRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return $this->filterWithModelConfiguration(DataStreamField::class, DataStreamField::getStoreRules());
	}
}
