<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ApiRequest extends FormRequest
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
	 * Alter rules using models configuration
	 *
	 * @param string $modelClass
	 * @param array $rules
	 * @return array
	 */
	public function filterWithModelConfiguration($modelClass, array $rules)
	{
		$modelsConfig = config('models');

		if (!isset($modelsConfig[$modelClass])) {
			return $rules;
		}

		$config = $modelsConfig[$modelClass];

		if (!isset($config['attributes'])) {
			return $rules;
		}

		foreach ($config['attributes'] as $attribute => $attributeConfig) {
			if (isset($attributeConfig['apiCannotFillOnUserGroups'])) {
				// Filter user only if already authenticated
				if (Auth::user()) {
					if (in_array(Auth::user()->user_group_id, $attributeConfig['apiCannotFillOnUserGroups'])) {
						unset($rules[$attribute]);
					}
				}
			}
		}

		return $rules;
	}
}