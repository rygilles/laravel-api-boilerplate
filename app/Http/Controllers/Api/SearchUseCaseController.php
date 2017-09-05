<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SearchSearchUseCaseRequest;
use App\Http\Requests\StoreSearchUseCaseRequest;
use App\Http\Requests\UpdateSearchUseCaseRequest;
use App\Http\Transformers\Api\SearchUseCaseTransformer;
use App\Models\SearchUseCase;

/**
 * @resource SearchUseCase
 *
 * @package App\Http\Controllers\Api
 */
class SearchUseCaseController extends ApiController
{
	/**
	 * SearchUseCaseController constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		// User group restrictions
		$this->middleware('verifyUserGroup:Developer,Support',  ['only' => ['index']]);
	}

	/**
	 * Show search use case list
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function index()
	{
		$searchUseCases = SearchUseCase::applyRequestQueryString()
									   ->withCount('searchUseCaseFields')
									   ->paginate();

		return $this->response->paginator($searchUseCases, new SearchUseCaseTransformer);
	}

	/**
	 * Get specified search use case
	 *
	 * @param string $searchUseCaseId Search use case UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function show($searchUseCaseId)
	{
		$searchUseCase = SearchUseCase::authorized(['Owner', 'Administrator'])
									  ->withCount('searchUseCaseFields')
									  ->find($searchUseCaseId);

		if (!$searchUseCase)
			return $this->response->errorNotFound();

		return $this->response->item($searchUseCase, new SearchUseCaseTransformer);
	}

	/**
	 * Create and store new search use case
	 *
	 * @ApiDocsNoCall
	 *
	 * @param StoreSearchUseCaseRequest $request
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function store(StoreSearchUseCaseRequest $request)
	{
		$searchUseCase = SearchUseCase::authorized(['Owner', 'Administrator'])
									  ->create($request->all(), $request->getRealMethod());

		if ($searchUseCase) {
			// Register model transformer for created/accepted responses
			// @link https://github.com/dingo/api/issues/1218
			app('Dingo\Api\Transformer\Factory')->register(
				SearchUseCase::class,
				SearchUseCaseTransformer::class
			);

			return $this->response->created(
				app('Dingo\Api\Routing\UrlGenerator')
					->version('v1')
					->route('searchUseCase.show', $searchUseCase->id),
				$searchUseCase);
		}

		return $this->response->errorBadRequest();
	}

	/**
	 * Update a search use case
	 *
	 * @ApiDocsNoCall
	 *
	 * @param UpdateSearchUseCaseRequest $request
	 * @param string $searchUseCaseId Search use case UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function update(UpdateSearchUseCaseRequest $request, $searchUseCaseId)
	{
		$searchUseCase = SearchUseCase::authorized(['Owner', 'Administrator'])
									  ->find($searchUseCaseId);

		if (!$searchUseCase)
			return $this->response->errorNotFound();

		$searchUseCase->fill($request->all(), $request->getRealMethod());
		$searchUseCase->save();

		return $this->response->item($searchUseCase, new SearchUseCaseTransformer);
	}

	/**
	 * Delete specified search use case
	 *
	 * @ApiDocsNoCall
	 *
	 * @param string $searchUseCaseId Search use case UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function destroy($searchUseCaseId)
	{
		$searchUseCase = SearchUseCase::authorized(['Owner', 'Administrator'])
									  ->find($searchUseCaseId);

		if (!$searchUseCase)
			return $this->response->errorNotFound();

		$searchUseCase->delete();

		return $this->response->noContent();
	}

	/**
	 * Perform search with the specified search use case
	 *
	 * @param SearchSearchUseCaseRequest $request
	 * @param string $searchUseCaseId Search use case UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function search(SearchSearchUseCaseRequest $request, $searchUseCaseId)
	{
		/** @var SearchUseCase $searchUseCase */
		/*
		$searchUseCase = SearchUseCase::authorized(['Owner', 'Administrator'])
									  ->find($searchUseCaseId);
		*/
		// TEMP : AUTHORIZED FOR ANYONE !!!
		$searchUseCase = SearchUseCase::find($searchUseCaseId);

		if (!$searchUseCase)
			return $this->response->errorNotFound();

		$i18n_lang_id = null;
		if ($request->has('i18n_lang_id')) {
			$i18n_lang_id = $request->get('i18n_lang_id');
		}

		$page = 1;
		if ($request->has('page')) {
			$page = $request->get('page');
		}

		$limit = 20;
		if ($request->has('limit')) {
			$limit = $request->get('limit');
		}
		
		$searchResultResponse = $searchUseCase->search($request->get('query_string'), $i18n_lang_id, $page, $limit);

		return $searchResultResponse;
	}
}
