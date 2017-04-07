<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreSearchEngineRequest;
use App\Http\Requests\UpdateSearchEngineRequest;
use App\Http\Transformers\Api\SearchEngineTransformer;
use App\Models\SearchEngine;
use Dingo\Api\Exception\ValidationHttpException;

/**
 * @resource SearchEngine
 *
 * @package App\Http\Controllers\Api
 */
class SearchEngineController extends ApiController
{
	/**
	 * I18nLangController constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		// User group restrictions
		$this->middleware('verifyUserGroup:Developer,Support')->only('index,show,store,update,delete');
	}

	/**
	 * Show search engine list
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function index()
	{
		$searchEngines = SearchEngine::paginate();

		return $this->response->paginator($searchEngines, new SearchEngineTransformer);
	}

	/**
	 * Get specified search engine
	 *
	 * @param $searchEngineId string Search Engine UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function show($searchEngineId)
	{
		$searchEngine = SearchEngine::find($searchEngineId);

		if (!$searchEngine)
			return $this->response->errorNotFound();

		return $this->response->item($searchEngine, new SearchEngineTransformer);
	}

	/**
	 * Create and store new search engine
	 *
	 * @ApiDocsNoCall
	 *
	 * @param StoreSearchEngineRequest $request
	 * @return \Dingo\Api\Http\Response|void
	 * @throws ValidationHttpException
	 */
	public function store(StoreSearchEngineRequest $request)
	{
		$searchEngine = SearchEngine::create($request->all());

		if ($searchEngine) {
			// Register model transformer for created/accepted responses
			// @link https://github.com/dingo/api/issues/1218
			app('Dingo\Api\Transformer\Factory')->register(
				'App\\Models\\SearchEngine',
				'App\\Http\\Transformers\\Api\\SearchEngineTransformer'
			);

			return $this->response->created(app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('searchEngine.show', $searchEngine->id), $searchEngine);
		}

		return $this->response->errorBadRequest();
	}

	/**
	 * Update a search engine
	 *
	 * @ApiDocsNoCall
	 *
	 * @param UpdateSearchEngineRequest $request
	 * @param $searchEngineId string User UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function update(UpdateSearchEngineRequest $request, $searchEngineId)
	{
		$searchEngine = SearchEngine::find($searchEngineId);

		if (!$searchEngine)
			return $this->response->errorNotFound();

		$searchEngine->fill($request->all());
		$searchEngine->save();

		return $this->response->item($searchEngine, new SearchEngineTransformer);
	}

	/**
	 * Delete specified search engine
	 *
	 * <aside class="warning">Avoid using this feature ! Check foreign keys constraints to remove dependent resources properly before.</aside>
	 *
	 * @ApiDocsNoCall
	 *
	 * @param $searchEngineId string Search Engine UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function destroy($searchEngineId)
	{
		$searchEngine = SearchEngine::find($searchEngineId);

		if (!$searchEngine)
			return $this->response->errorNotFound();

		$searchEngine->delete();

		return $this->response->noContent();
	}
}
