<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\WidgetTransformer;
use App\Models\SearchUseCase;

/**
 * @resource Widget
 * @todo Security ?
 * @package App\Http\Controllers\Api
 */
class SearchUseCaseWidgetController extends ApiController
{
	/**
	 * SearchUseCaseWidgetController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Search use case widget list
	 *
	 * @param string $searchUseCaseId Search use case UUID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index($searchUseCaseId)
	{
		$searchUseCase = SearchUseCase::authorized(['Owner', 'Administrator'])->find($searchUseCaseId);

		if (!$searchUseCase)
			return $this->response->errorNotFound();

		$paginator = $searchUseCase->widgets()->applyRequestQueryString()->paginate();

		return $this->response->paginator($paginator, new WidgetTransformer);
	}
}
