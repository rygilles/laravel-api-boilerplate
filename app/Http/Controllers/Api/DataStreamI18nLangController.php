<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\I18nLangTransformer;
use App\Models\DataStream;

/**
 * @resource I18nLang
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

		// User group restrictions
		$this->middleware('verifyUserGroup:Developer,Support', ['only' => ['index']]);
	}

	/**
	 * Data stream i18n lang list
	 *
	 * @param string $dataStreamId Data Stream UUID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index($dataStreamId)
	{
		$dataStream = DataStream::find($dataStreamId);

		if (!$dataStream)
			return $this->response->errorNotFound();

		$paginator = $dataStream->i18nLangs()->applyRequestQueryString()->paginate();

		return $this->response->paginator($paginator, new I18nLangTransformer);
	}
}
