<?php

namespace App\Http\Requests;

use App\Models\Widget;

class StoreWidgetRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return $this->filterWithModelConfiguration(Widget::class, Widget::getStoreRules());
	}
}
