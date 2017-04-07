<?php

namespace App\Http\Requests;

use App\Models\I18nLang;

class StoreI18nLangRequest extends ApiRequest
{
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return $this->filterWithModelConfiguration(I18nLang::class, I18nLang::getStoreRules());
	}
}
