<?php

namespace App\Http\Requests;

class SearchSearchUseCaseRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'query_string'  => 'required|string|min:1',
			'i18n_lang_id'  => 'string|max:30|exists:i18n_lang,id',
			'page'          => 'int:min:1',
			'limit'         => 'int:min:1',
		];
	}
}
