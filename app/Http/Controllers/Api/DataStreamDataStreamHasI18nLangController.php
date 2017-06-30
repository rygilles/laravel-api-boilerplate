<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\DataStreamHasI18nLangTransformer;
use App\Models\DataStream;

/**
 * @resource DataStreamHasI18nLang
 * @todo Security ?
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

		// User group restrictions
		$this->middleware('verifyUserGroup:Developer,Support', ['only' => ['index', 'show']]);
	}

	/**
	 * Data stream relationship between data stream and i18n langs list
	 *
	 * @param string $dataStreamId Data Stream UUID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index($dataStreamId)
	{
		$dataStream = DataStream::find($dataStreamId);

		if (!$dataStream)
			return $this->response->errorNotFound();

		$paginator = $dataStream->dataStreamHasI18nLangs()->applyRequestQueryString()->paginate();
		
		return $this->response->paginator($paginator, new DataStreamHasI18nLangTransformer);
	}
}
