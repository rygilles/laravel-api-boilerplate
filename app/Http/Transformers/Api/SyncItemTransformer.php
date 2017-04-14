<?php

namespace App\Http\Transformers\Api;

use App\Models\SyncItem;

class SyncItemTransformer extends ApiTransformer
{
	/**
	 * Turn this item object into a generic array
	 *
	 * @param SyncItem $syncItem
	 * @return array
	 */
	public function transform(SyncItem $syncItem)
	{
		return $this->filterWithModelConfiguration(
			SyncItem::class,
			[
				'item_id'           => $syncItem->item_id,
				'project_id'        => $syncItem->project_id,
				'item_signature'    => $syncItem->item_signature,
				'created_at'        => $syncItem->created_at->toDateTimeString(),
				'updated_at'        => $syncItem->updated_at->toDateTimeString()
			]
		);
	}
}