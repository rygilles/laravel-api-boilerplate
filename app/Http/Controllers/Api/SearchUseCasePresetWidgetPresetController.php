<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\WidgetPresetTransformer;
use App\Models\SearchUseCasePreset;

/**
 * @resource WidgetPreset
 * @OpenApiOperationTag Resource:SearchUseCasePreset
 *
 * @package App\Http\Controllers\Api
 */
class SearchUseCasePresetWidgetPresetController extends ApiController
{
	/**
	 * SearchUseCasePresetWidgetPresetController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Search use case preset widget presets list
	 *
	 * @OpenApiOperationId getWidgetPresets
	 * @OpenApiResponseSchemaRef #/components/schemas/WidgetPresetListResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A WidgetPresetField list
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

		$paginator = $searchUseCasePreset->widgetPresets()->applyRequestQueryString()->paginate();

		return $this->response->paginator($paginator, new WidgetPresetTransformer);
	}
}
