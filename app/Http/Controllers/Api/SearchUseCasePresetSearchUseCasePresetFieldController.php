<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\SearchUseCasePresetFieldTransformer;
use App\Models\SearchUseCasePreset;

/**
 * @resource SearchUseCasePresetField
 * @OpenApiOperationTag Resource:SearchUseCasePreset
 *
 * @package App\Http\Controllers\Api
 */
class SearchUseCasePresetSearchUseCasePresetFieldController extends ApiController
{
	/**
	 * SearchUseCasePresetSearchUseCasePresetFieldController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Search use case preset search use case preset fields list
	 *
	 * @OpenApiOperationId getFieldPresets
	 * @OpenApiResponseSchemaRef #/components/schemas/SearchUseCasePresetFieldListResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A SearchUseCasePresetField list
	 * @OpenApiExtraParameterRef #/components/parameters/Search
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationPage
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationLimit
	 * @OpenApiExtraParameterRef #/components/parameters/OrderBy
	 *
	 * @param string $searchUseCasePresetId Search use case preset UUID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index($searchUseCasePresetId)
	{
		$searchUseCasePreset = SearchUseCasePreset::find($searchUseCasePresetId);

		if (!$searchUseCasePreset)
			return $this->response->errorNotFound();

		$paginator = $searchUseCasePreset->searchUseCasePresetFields()->applyRequestQueryString()->paginate();

		return $this->response->paginator($paginator, new SearchUseCasePresetFieldTransformer);
	}
}
