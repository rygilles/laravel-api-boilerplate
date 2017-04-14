<?php

namespace App\Http\Requests;

use App\Models\DataStream;

class StoreProjectDataStreamRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return $this->filterWithModelConfiguration(DataStream::class, DataStream::getStoreRules());
	}
}
