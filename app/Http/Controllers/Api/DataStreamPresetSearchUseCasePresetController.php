<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\SearchUseCasePresetTransformer;
use App\Models\DataStreamPreset;

/**
 * @resource SearchUseCasePreset
 * @OpenApiOperationTag Resource:DataStream
 *
 * @package App\Http\Controllers\Api
 */
class DataStreamPresetSearchUseCasePresetController extends ApiController
{
	/**
	 * DataStreamPresetSearchUseCasePresetController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Data stream preset search use case preset list
	 *
	 * @OpenApiOperationId getSearchUseCasePresets
	 * @OpenApiResponseSchemaRef #/components/schemas/SearchUseCasePresetListResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A SearchUseCasePreset list
	 * @OpenApiExtraParameterRef #/components/parameters/Search
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationPage
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationLimit
	 * @OpenApiExtraParameterRef #/components/parameters/OrderBy
	 *
	 * @param string $dataStreamPresetId Data stream preset UUID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index($dataStreamPresetId)
	{
		$dataStreamPreset = DataStreamPreset::find($dataStreamPresetId);

		if (!$dataStreamPreset)
			return $this->response->errorNotFound();

		$paginator = $dataStreamPreset->searchUseCasePresets()
									  ->applyRequestQueryString()
									  ->paginate();

		return $this->response->paginator($paginator, new SearchUseCasePresetTransformer);
	}
}
