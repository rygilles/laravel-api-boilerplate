<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\DataStreamFieldTransformer;
use App\Models\DataStream;

/**
 * @resource DataStreamField
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
	 *	 *
	 * @param string $dataStreamId Data stream UUID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index($dataStreamId)
	{
		$dataStream = DataStream::find($dataStreamId);

		if (!$dataStream)
			return $this->response->errorNotFound();

		$paginator = $dataStream->dataStreamFields()
								->applyRequestQueryString()
								->paginate();

		return $this->response->paginator($paginator, new DataStreamFieldTransformer);
	}
}
