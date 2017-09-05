<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreDataStreamPresetRequest;
use App\Http\Requests\UpdateDataStreamPresetRequest;
use App\Http\Transformers\Api\DataStreamPresetTransformer;
use App\Models\DataStreamPreset;
use Dingo\Api\Exception\ValidationHttpException;
use Dingo\Api\Routing\UrlGenerator;
use Dingo\Api\Transformer\Factory;

/**
 * @resource DataStreamPreset
 *
 * @package App\Http\Controllers\Api
 */
class DataStreamPresetController extends ApiController
{
	/**
	 * DataStreamPresetController constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		// User group restrictions
		$this->middleware('verifyUserGroup:Developer,Support', ['only' => ['store', 'update', 'destroy']]);
	}

	/**
	 * Show data stream preset list
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function index()
	{
		$dataStreamPresets = DataStreamPreset::applyRequestQueryString()->paginate();

		return $this->response->paginator($dataStreamPresets, new DataStreamPresetTransformer);
	}

	/**
	 * Get specified data stream preset
	 *
	 * @param string $dataStreamPresetId Data stream preset UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function show($dataStreamPresetId)
	{
		$dataStreamPreset = DataStreamPreset::find($dataStreamPresetId);

		if (!$dataStreamPreset)
			return $this->response->errorNotFound();

		return $this->response->item($dataStreamPreset, new DataStreamPresetTransformer);
	}

	/**
	 * Create and store new data stream preset
	 *
	 * @ApiDocsNoCall
	 *
	 * @param StoreDataStreamPresetRequest $request
	 * @return \Dingo\Api\Http\Response|void
	 * @throws ValidationHttpException
	 */
	public function store(StoreDataStreamPresetRequest $request)
	{
		$dataStreamPreset = DataStreamPreset::create($request->all(), $request->getRealMethod());

		if ($dataStreamPreset) {
			// Register model transformer for created/accepted responses
			// @link https://github.com/dingo/api/issues/1218
			app(Factory::class)->register(
				DataStreamPreset::class,
				DataStreamPresetTransformer::class
			);

			return $this->response->created(
				app(UrlGenerator::class)
					->version('v1')
					->route('dataStreamPreset.show', $dataStreamPreset->id),
				$dataStreamPreset);
		}

		return $this->response->errorBadRequest();
	}

	/**
	 * Update a data stream preset
	 *
	 * @ApiDocsNoCall
	 *
	 * @param UpdateDataStreamPresetRequest $request
	 * @param string $dataStreamPresetId Data stream preset UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function update(UpdateDataStreamPresetRequest $request, $dataStreamPresetId)
	{
		$dataStreamPreset = DataStreamPreset::find($dataStreamPresetId);

		if (!$dataStreamPreset)
			return $this->response->errorNotFound();

		$dataStreamPreset->fill($request->all(), $request->getRealMethod());
		$dataStreamPreset->save();

		return $this->response->item($dataStreamPreset, new DataStreamPresetTransformer);
	}

	/**
	 * Delete specified data stream preset
	 **
	 * @ApiDocsNoCall
	 *
	 * @param string $dataStreamPresetId Data stream preset UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function destroy($dataStreamPresetId)
	{
		$dataStreamPreset = DataStreamPreset::find($dataStreamPresetId);

		if (!$dataStreamPreset)
			return $this->response->errorNotFound();

		$dataStreamPreset->delete();

		return $this->response->noContent();
	}
}
