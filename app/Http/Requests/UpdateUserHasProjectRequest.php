<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest;
use App\Models\UserHasProject;

class UpdateUserHasProjectRequest extends FormRequest
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
		if ($this->isMethod('PATCH')) {
			return UserHasProject::getPatchRules();
		} elseif ($this->isMethod('PUT')) {
			return UserHasProject::getPutRules();
		} else {
			// @fixme Api documentation generator method "GET" for update... return PUT method rules
			return UserHasProject::getPutRules();
		}
	}
}
