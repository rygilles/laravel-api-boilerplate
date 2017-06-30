<?php

namespace App\Http\Transformers\Api;

use App\Models\SearchEngine;

class SearchEngineTransformer extends ApiTransformer
{
	/**
	 * Turn this item object into a generic array
	 *
	 * @param SearchEngine $searchEngine
	 * @return array
	 */
	public function transform(SearchEngine $searchEngine)
	{
		return $this->filterWithModelConfiguration(
			SearchEngine::class,
				[
				'id'                => $searchEngine->id,
				'name'              => $searchEngine->name,
				'class_name'        => $searchEngine->class_name,
				'created_at'        => $searchEngine->created_at->toDateTimeString(),
				'updated_at'        => $searchEngine->updated_at->toDateTimeString(),
				'projects_count'    => (int) $searchEngine->projects_count,
			]
		);
	}
}