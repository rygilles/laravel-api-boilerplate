<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\SearchUseCaseFieldTransformer;
use App\Models\SearchUseCase;

/**
 * @resource SearchUseCaseField
 * @todo Security ?
 * @package App\Http\Controllers\Api
 */
class SearchUseCaseSearchUseCaseFieldController extends ApiController
{
	/**
	 * SearchUseCaseSearchUseCaseFieldController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Search use case search use case fields list
	 *
	 * @param string $searchUseCaseId Search use case UUID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index($searchUseCaseId)
	{
		$searchUseCase = SearchUseCase::authorized(['Owner', 'Administrator'])->find($searchUseCaseId);

		if (!$searchUseCase)
			return $this->response->errorNotFound();

		$paginator = $searchUseCase->searchUseCaseFields()->applyRequestQueryString()->paginate();

		return $this->response->paginator($paginator, new SearchUseCaseFieldTransformer);
	}
}
