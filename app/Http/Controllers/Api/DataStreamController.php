<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreDataStreamRequest;
use App\Http\Requests\UpdateDataStreamRequest;
use App\Http\Transformers\Api\DataStreamTransformer;
use App\Models\DataStream;

/**
 * @resource DataStream
 * @OpenApiOperationTag Manager:DataStream
 *
 * @package App\Http\Controllers\Api
 */
class DataStreamController extends ApiController
{
	/**
	 * DataStreamController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		
		// User group restrictions
		$this->middleware('verifyUserGroup:Developer,Support',  ['only' => ['index', 'store', 'update', 'destroy']]);
	}

	/**
	 * Show data stream list
	 *
	 * @OpenApiOperationId all
	 * @OpenApiResponseSchemaRef #/components/schemas/DataStreamListResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A DataStream list
	 * @OpenApiExtraParameterRef #/components/parameters/Include
	 * @OpenApiExtraParameterRef #/components/parameters/Search
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationPage
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationLimit
	 * @OpenApiExtraParameterRef #/components/parameters/OrderBy
	 * 
	 * @return \Dingo\Api\Http\Response
	 */
	public function index()
	{
		$dataStreams = DataStream::applyRequestQueryString()->paginate();

		return $this->response->paginator($dataStreams, new DataStreamTransformer);
	}

	/**
	 * Get specified data stream
	 *
	 * @OpenApiOperationId get
	 * @OpenApiResponseSchemaRef #/components/schemas/DataStreamResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A DataStream
	 * @OpenApiExtraParameterRef #/components/parameters/Include
	 *
	 * @param string $dataStreamId Data stream UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function show($dataStreamId)
	{
		$dataStream = DataStream::authorized(['Owner', 'Administrator'])->find($dataStreamId);

		if (!$dataStream)
			return $this->response->errorNotFound();

		return $this->response->item($dataStream, new DataStreamTransformer);
	}

	/**
	 * Create and store new data stream
	 *
	 * Only one data stream per project is allowed.
	 *
	 * @ApiDocsNoCall
	 * 
	 * @OpenApiOperationId create
	 * @OpenApiResponseSchemaRef #/components/schemas/DataStreamResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A DataStream
	 *
	 * @param StoreDataStreamRequest $request
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function store(StoreDataStreamRequest $request)
	{
		$dataStream = DataStream::create($request->all(), $request->getRealMethod());

		if ($dataStream) {
			// Register model transformer for created/accepted responses
			// @link https://github.com/dingo/api/issues/1218
			app('Dingo\Api\Transformer\Factory')->register(
				DataStream::class,
				DataStreamTransformer::class
			);

			return $this->response->created(
				app('Dingo\Api\Routing\UrlGenerator')
					->version('v1')
					->route('dataStream.show', $dataStream->id),
				$dataStream);
		}

		return $this->response->errorBadRequest();
	}

	/**
	 * Update a data stream
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId update
	 * @OpenApiOperationTag Resource:DataStream
	 * @OpenApiResponseSchemaRef #/components/schemas/DataStreamResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription The updated DataStream
	 *
	 * @param UpdateDataStreamRequest $request
	 * @param string $dataStreamId Data stream UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function update(UpdateDataStreamRequest $request, $dataStreamId)
	{
		$dataStream = DataStream::find($dataStreamId);

		if (!$dataStream)
			return $this->response->errorNotFound();

		$dataStream->fill($request->all(), $request->getRealMethod());
		$dataStream->save();

		return $this->response->item($dataStream, new DataStreamTransformer);
	}

	/**
	 * Delete specified data stream
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId delete
	 * @OpenApiOperationTag Resource:DataStream
	 * @OpenApiResponseDescription Empty response
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 *
	 * @param string $dataStreamId Data stream UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function destroy($dataStreamId)
	{
		$dataStream = DataStream::find($dataStreamId);

		if (!$dataStream)
			return $this->response->errorNotFound();

		$dataStream->delete();

		return $this->response->noContent();
	}
}
