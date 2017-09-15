<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\DataStreamPresetFieldTransformer;
use App\Models\DataStreamPreset;

/**
 * @resource DataStreamPresetField
 * @OpenApiOperationTag Resource:DataStreamPreset
 *
 * @package App\Http\Controllers\Api
 */
class DataStreamPresetDataStreamPresetFieldController extends ApiController
{
	/**
	 * DataStreamPresetDataStreamPresetFieldController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Data stream preset data stream preset field list
	 *
	 * @OpenApiOperationId getFields
	 * @OpenApiResponseSchemaRef #/components/schemas/DataStreamPresetFieldListResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A DataStreamPresetField list
	 * @OpenApiExtraParameterRef #/components/parameters/Include
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

		$paginator = $dataStreamPreset->dataStreamPresetFields()
									  ->applyRequestQueryString()
									  ->paginate();

		return $this->response->paginator($paginator, new DataStreamPresetFieldTransformer);
	}
}
