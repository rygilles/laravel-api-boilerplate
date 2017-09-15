<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreDataStreamDecoderRequest;
use App\Http\Requests\UpdateDataStreamDecoderRequest;
use App\Http\Transformers\Api\DataStreamDecoderTransformer;
use App\Models\DataStreamDecoder;

/**
 * @resource DataStreamDecoder
 * @OpenApiOperationTag Manager:DataStreamDecoder
 *
 * @package App\Http\Controllers\Api
 */
class DataStreamDecoderController extends ApiController
{
	/**
	 * DataStreamDecoderController constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		// User group restrictions
		$this->middleware('verifyUserGroup:Developer,Support',  ['only' => ['store', 'update', 'destroy']]);
	}

	/**
	 * Show data stream decoder list
	 *
	 * @OpenApiOperationId all
	 * @OpenApiResponseSchemaRef #/components/schemas/DataStreamDecoderListResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A DataStreamDecoder list
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
		$dataStreamDecoders = DataStreamDecoder::paginate();

		return $this->response->paginator($dataStreamDecoders, new DataStreamDecoderTransformer);
	}

	/**
	 * Get specified data stream decoder
	 *
	 * @OpenApiOperationId get
	 * @OpenApiResponseSchemaRef #/components/schemas/DataStreamDecoderResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A DataStreamDecoder
	 * @OpenApiExtraParameterRef #/components/parameters/Include
	 *
	 * @param string $dataStreamDecoderId Data stream decoder UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function show($dataStreamDecoderId)
	{
		$dataStreamDecoder = DataStreamDecoder::find($dataStreamDecoderId);

		if (!$dataStreamDecoder)
			return $this->response->errorNotFound();

		return $this->response->item($dataStreamDecoder, new DataStreamDecoderTransformer);
	}

	/**
	 * Create and store new data stream decoder
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId create
	 * @OpenApiResponseSchemaRef #/components/schemas/DataStreamDecoderResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A DataStreamDecoderResponse
	 *
	 * @param StoreDataStreamDecoderRequest $request
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function store(StoreDataStreamDecoderRequest $request)
	{
		$dataStreamDecoder = DataStreamDecoder::create($request->all(), $request->getRealMethod());

		if ($dataStreamDecoder) {
			// Register model transformer for created/accepted responses
			// @link https://github.com/dingo/api/issues/1218
			app('Dingo\Api\Transformer\Factory')->register(
				DataStreamDecoder::class,
				DataStreamDecoderTransformer::class
			);

			return $this->response->created(
				app('Dingo\Api\Routing\UrlGenerator')
					->version('v1')
					->route('dataStreamDecoder.show', $dataStreamDecoder->id),
				$dataStreamDecoder);
		}

		return $this->response->errorBadRequest();
	}

	/**
	 * Update a data stream decoder
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId update
	 * @OpenApiOperationTag Resource:DataStreamDecoder
	 * @OpenApiResponseSchemaRef #/components/schemas/DataStreamDecoderResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription The updated DataStreamDecoder
	 *
	 * @param UpdateDataStreamDecoderRequest $request
	 * @param string $dataStreamDecoderId Data stream decoder UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function update(UpdateDataStreamDecoderRequest $request, $dataStreamDecoderId)
	{
		$dataStreamDecoder = DataStreamDecoder::find($dataStreamDecoderId);

		if (!$dataStreamDecoder)
			return $this->response->errorNotFound();

		$dataStreamDecoder->fill($request->all(), $request->getRealMethod());
		$dataStreamDecoder->save();

		return $this->response->item($dataStreamDecoder, new DataStreamDecoderTransformer);
	}

	/**
	 * Delete specified data stream decoder
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId delete
	 * @OpenApiOperationTag Resource:DataStreamDecoder
	 * @OpenApiResponseDescription Empty response
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 *
	 * @param string $dataStreamDecoderId Data stream decoder UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function destroy($dataStreamDecoderId)
	{
		$dataStreamDecoder = DataStreamDecoder::find($dataStreamDecoderId);

		if (!$dataStreamDecoder)
			return $this->response->errorNotFound();

		$dataStreamDecoder->delete();

		return $this->response->noContent();
	}
}
