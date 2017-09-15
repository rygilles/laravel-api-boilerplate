<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\DataStreamHasI18nLangTransformer;
use App\Models\DataStream;

/**
 * @resource DataStreamHasI18nLang
 * @OpenApiOperationTag Resource:DataStream
 * 
 * @package App\Http\Controllers\Api
 */
class DataStreamDataStreamHasI18nLangController extends ApiController
{
	/**
	 * DataStreamDataStreamHasI8nLangController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Data stream relationship between data stream and i18n langs list
	 *
	 * @OpenApiOperationId getDataStreamHasI18nLangs
	 * @OpenApiResponseSchemaRef #/components/schemas/DataStreamHasI18nLangListResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A DataStreamHasI18nLang list
	 * @OpenApiExtraParameterRef #/components/parameters/Include
	 * @OpenApiExtraParameterRef #/components/parameters/Search
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationPage
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationLimit
	 * @OpenApiExtraParameterRef #/components/parameters/OrderBy
	 * 
	 * @param string $dataStreamId Data Stream UUID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index($dataStreamId)
	{
		$dataStream = DataStream::authorized(['Owner', 'Administrator'])->find($dataStreamId);

		if (!$dataStream)
			return $this->response->errorNotFound();

		$paginator = $dataStream->dataStreamHasI18nLangs()->applyRequestQueryString()->paginate();
		
		return $this->response->paginator($paginator, new DataStreamHasI18nLangTransformer);
	}
}
