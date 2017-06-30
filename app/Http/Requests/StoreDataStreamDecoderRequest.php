<?php

namespace App\Http\Requests;

use App\Models\DataStreamDecoder;

class StoreDataStreamDecoderRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return $this->filterWithModelConfiguration(DataStreamDecoder::class, DataStreamDecoder::getStoreRules());
	}
}
