<?php

namespace App\Http\Requests;

use App\Models\SyncItem;

class UpdateSyncItemRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		if ($this->isMethod('PATCH')) {
			return $this->filterWithModelConfiguration(SyncItem::class, SyncItem::getPatchRules());
		} elseif ($this->isMethod('PUT')) {
			return $this->filterWithModelConfiguration(SyncItem::class, SyncItem::getPutRules());
		} else {
			// @fixme Api documentation generator method "GET" for update... return PUT method rules
			return $this->filterWithModelConfiguration(SyncItem::class, SyncItem::getPutRules());
		}
	}
}
