<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest;
use App\Models\I18nLang;

class StoreI18nLangRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return I18nLang::getStoreRules();
	}
}
