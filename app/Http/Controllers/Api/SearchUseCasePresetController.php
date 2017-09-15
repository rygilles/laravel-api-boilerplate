<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreSearchUseCasePresetRequest;
use App\Http\Requests\UpdateSearchUseCasePresetRequest;
use App\Http\Transformers\Api\SearchUseCasePresetTransformer;
use App\Models\SearchUseCasePreset;

/**
 * @resource SearchUseCasePreset
 * @OpenApiOperationTag Manager:SearchUseCasePreset
 *
 * @package App\Http\Controllers\Api
 */
class SearchUseCasePresetController extends ApiController
{
	/**
	 * SearchUseCasePresetController constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		// User group restrictions
		$this->middleware('verifyUserGroup:Developer,Support', ['only' => ['store', 'update', 'destroy']]);
	}

	/**
	 * Show search use case preset list
	 *
	 * @OpenApiOperationId all
	 * @OpenApiResponseSchemaRef #/components/schemas/SearchUseCasePresetListResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A SearchUseCasePreset list
	 * @OpenApiExtraParameterRef #/components/parameters/Include
	 * @OpenApiExtraParameterRef #/components/parameters/Search
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationPage
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationLimit
	 * @OpenApiExtraParameterRef #/components/parameters/OrderBy
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function index()
	{
		$searchUseCasePresets = SearchUseCasePreset::applyRequestQueryString()
									               ->withCount('searchUseCasePresetFields')
									               ->paginate();

		return $this->response->paginator($searchUseCasePresets, new SearchUseCasePresetTransformer);
	}

	/**
	 * Get specified search use case preset
	 *
	 * @OpenApiOperationId get
	 * @OpenApiResponseSchemaRef #/components/schemas/SearchUseCasePresetResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A SearchUseCasePreset
	 * @OpenApiExtraParameterRef #/components/parameters/Include
	 *
	 * @param string $searchUseCasePresetId Search use case preset UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function show($searchUseCasePresetId)
	{
		$searchUseCasePreset = SearchUseCasePreset::withCount('searchUseCasePresetFields')
									              ->find($searchUseCasePresetId);

		if (!$searchUseCasePreset)
			return $this->response->errorNotFound();

		return $this->response->item($searchUseCasePreset, new SearchUseCasePresetTransformer);
	}

	/**
	 * Create and store new search use case preset
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId create
	 * @OpenApiResponseSchemaRef #/components/schemas/SearchUseCasePresetResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription The created SearchUseCasePreset
	 *
	 * @param StoreSearchUseCasePresetRequest $request
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function store(StoreSearchUseCasePresetRequest $request)
	{
		$searchUseCasePreset = SearchUseCasePreset::create($request->all(), $request->getRealMethod());

		if ($searchUseCasePreset) {
			// Register model transformer for created/accepted responses
			// @link https://github.com/dingo/api/issues/1218
			app('Dingo\Api\Transformer\Factory')->register(
				SearchUseCasePreset::class,
				SearchUseCasePresetTransformer::class
			);

			return $this->response->created(
				app('Dingo\Api\Routing\UrlGenerator')
					->version('v1')
					->route('searchUseCasePreset.show', $searchUseCasePreset->id),
				$searchUseCasePreset);
		}

		return $this->response->errorBadRequest();
	}

	/**
	 * Update a search use case preset
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId update
	 * @OpenApiOperationTag Resource:SearchUseCasePreset
	 * @OpenApiResponseSchemaRef #/components/schemas/SearchUseCasePresetResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription The updated SearchUseCasePreset
	 *
	 * @param UpdateSearchUseCasePresetRequest $request
	 * @param string $searchUseCasePresetId Search use case preset UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function update(UpdateSearchUseCasePresetRequest $request, $searchUseCasePresetId)
	{
		$searchUseCasePreset = SearchUseCasePreset::find($searchUseCasePresetId);

		if (!$searchUseCasePreset)
			return $this->response->errorNotFound();

		$searchUseCasePreset->fill($request->all(), $request->getRealMethod());
		$searchUseCasePreset->save();

		return $this->response->item($searchUseCasePreset, new SearchUseCasePresetTransformer);
	}

	/**
	 * Delete specified search use case preset
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId delete
	 * @OpenApiOperationTag Resource:SearchUseCasePreset
	 * @OpenApiResponseDescription Empty response
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 *
	 * @param string $searchUseCasePresetId Search use case preset UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function destroy($searchUseCasePresetId)
	{
		$searchUseCasePreset = SearchUseCasePreset::find($searchUseCasePresetId);

		if (!$searchUseCasePreset)
			return $this->response->errorNotFound();

		$searchUseCasePreset->delete();

		return $this->response->noContent();
	}
}
