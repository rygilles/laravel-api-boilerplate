<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\ProjectTransformer;
use App\Models\SearchEngine;

/**
 * @resource Project
 *
 * @package App\Http\Controllers\Api
 */
class SearchEngineProjectController extends ApiController
{
	/**
	 * Search engine project list
	 * 
	 * @param string $searchEngineId Search Engine UUID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index($searchEngineId)
	{
		$searchEngine = SearchEngine::find($searchEngineId);

		if (!$searchEngine)
			return $this->response->errorNotFound();

		$paginator = $searchEngine->projects()->paginate();

		return $this->response->paginator($paginator, new ProjectTransformer);
	}
}
