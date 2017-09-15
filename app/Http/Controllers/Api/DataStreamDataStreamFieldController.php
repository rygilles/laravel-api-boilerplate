<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\DataStreamFieldTransformer;
use App\Models\DataStream;

/**
 * @resource DataStreamField
 * @OpenApiOperationTag Resource:DataStream
 *
 * @package App\Http\Controllers\Api
 */
class DataStreamDataStreamFieldController extends ApiController
{
	/**
	 * DataStreamDataStreamFieldController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Data stream data stream field list
	 *
	 * @OpenApiOperationId getFields
	 * @OpenApiResponseSchemaRef #/components/schemas/DataStreamFieldListResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A DataStreamField list
	 * @OpenApiExtraParameterRef #/components/parameters/Include
	 * @OpenApiExtraParameterRef #/components/parameters/Search
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationPage
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationLimit
	 * @OpenApiExtraParameterRef #/components/parameters/OrderBy
	 *
	 * @param string $dataStreamId Data stream UUID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index($dataStreamId)
	{
		$dataStream = DataStream::authorized(['Owner', 'Administrator'])->find($dataStreamId);

		if (!$dataStream)
			return $this->response->errorNotFound();

		$paginator = $dataStream->dataStreamFields()
								->applyRequestQueryString()
								->paginate();

		return $this->response->paginator($paginator, new DataStreamFieldTransformer);
	}
}
