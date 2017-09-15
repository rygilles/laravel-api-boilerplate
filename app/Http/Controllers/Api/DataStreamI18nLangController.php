<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\I18nLangTransformer;
use App\Models\DataStream;

/**
 * @resource I18nLang
 * @OpenApiOperationTag Resource:DataStream
 *
 * @package App\Http\Controllers\Api
 */
class DataStreamI18nLangController extends ApiController
{
	/**
	 * UserProjectController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Data stream i18n lang list
	 *
	 * @OpenApiOperationId getI18nLangs
	 * @OpenApiResponseSchemaRef #/components/schemas/I18nLangListResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A I18nLang list
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

		$paginator = $dataStream->i18nLangs()->applyRequestQueryString()->paginate();

		return $this->response->paginator($paginator, new I18nLangTransformer);
	}
}
