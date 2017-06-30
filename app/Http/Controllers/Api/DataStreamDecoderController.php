<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreDataStreamDecoderRequest;
use App\Http\Requests\UpdateDataStreamDecoderRequest;
use App\Http\Transformers\Api\DataStreamDecoderTransformer;
use App\Models\DataStreamDecoder;

/**
 * @resource DataStreamDecoder
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
	 * @param $dataStreamDecoderId string Data stream decoder UUID
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
	 * @param UpdateDataStreamDecoderRequest $request
	 * @param $dataStreamDecoderId string Data stream decoder UUID
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
	 * @param $dataStreamDecoderId string Data stream decoder UUID
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
