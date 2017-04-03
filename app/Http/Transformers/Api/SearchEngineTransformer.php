<?php

namespace App\Http\Transformers\Api;

use League\Fractal\TransformerAbstract;
use App\Models\SearchEngine;

class SearchEngineTransformer extends TransformerAbstract
{
	/**
	 * Turn this item object into a generic array
	 *
	 * @param SearchEngine $searchEngine
	 * @return array
	 */
	public function transform(SearchEngine $searchEngine)
	{
		return [
			'id'            => $searchEngine->id,
			'name'          => $searchEngine->name,
			'created_at'    => $searchEngine->created_at->toDateTimeString(),
			'updated_at'    => $searchEngine->updated_at->toDateTimeString()
		];
	}
}