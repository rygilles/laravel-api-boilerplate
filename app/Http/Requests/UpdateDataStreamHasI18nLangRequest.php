<?php

namespace App\Http\Requests;

use App\Models\DataStreamHasI18nLang;

class UpdateDataStreamHasI18nLangRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		if ($this->isMethod('PATCH')) {
			return $this->filterWithModelConfiguration(DataStreamHasI18nLang::class, DataStreamHasI18nLang::getPatchRules());
		} elseif ($this->isMethod('PUT')) {
			return $this->filterWithModelConfiguration(DataStreamHasI18nLang::class, DataStreamHasI18nLang::getPutRules());
		} else {
			// @fixme Api documentation generator method "GET" for update... return PUT method rules
			return $this->filterWithModelConfiguration(DataStreamHasI18nLang::class, DataStreamHasI18nLang::getPutRules());
		}
	}
}
