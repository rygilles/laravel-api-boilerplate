<?php

namespace App\Http\Requests;

use App\Models\DataStreamHasI18nLang;

class StoreDataStreamHasI18nLangRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return $this->filterWithModelConfiguration(DataStreamHasI18nLang::class, DataStreamHasI18nLang::getStoreRules());
	}
}
