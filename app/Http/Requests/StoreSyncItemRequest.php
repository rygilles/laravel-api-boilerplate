<?php

namespace App\Http\Requests;

use App\Models\SyncItem;

class StoreSyncItemRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return $this->filterWithModelConfiguration(SyncItem::class, SyncItem::getStoreRules());
	}
}
