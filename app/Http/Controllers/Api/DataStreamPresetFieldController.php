<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreDataStreamPresetFieldRequest;
use App\Http\Requests\UpdateDataStreamPresetFieldRequest;
use App\Http\Transformers\Api\DataStreamPresetFieldTransformer;
use App\Models\DataStreamPresetField;
use Dingo\Api\Exception\ValidationHttpException;
use Dingo\Api\Routing\UrlGenerator;
use Dingo\Api\Transformer\Factory;

/**
 * @resource DataStreamPresetField
 *
 * @package App\Http\Controllers\Api
 */
class DataStreamPresetFieldController extends ApiController
{
	/**
	 * DataStreamPresetFieldController constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		// User group restrictions
		$this->middleware('verifyUserGroup:Developer,Support', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
	}

	/**
	 * Show data stream preset field list
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function index()
	{
		$dataStreamPresetFields = DataStreamPresetField::applyRequestQueryString()->paginate();

		return $this->response->paginator($dataStreamPresetFields, new DataStreamPresetFieldTransformer);
	}

	/**
	 * Get specified data stream preset field
	 *
	 * @param $dataStreamPresetFieldId string Data stream preset field UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function show($dataStreamPresetFieldId)
	{
		$dataStreamPresetField = DataStreamPresetField::find($dataStreamPresetFieldId);

		if (!$dataStreamPresetField)
			return $this->response->errorNotFound();

		return $this->response->item($dataStreamPresetField, new DataStreamPresetFieldTransformer);
	}

	/**
	 * Create and store new data stream preset field
	 *
	 * @ApiDocsNoCall
	 *
	 * @param StoreDataStreamPresetFieldRequest $request
	 * @return \Dingo\Api\Http\Response|void
	 * @throws ValidationHttpException
	 */
	public function store(StoreDataStreamPresetFieldRequest $request)
	{
		$dataStreamPresetField = DataStreamPresetField::create($request->all(), $request->getRealMethod());

		if ($dataStreamPresetField) {
			// Register model transformer for created/accepted responses
			// @link https://github.com/dingo/api/issues/1218
			app(Factory::class)->register(
				DataStreamPresetField::class,
				DataStreamPresetFieldTransformer::class
			);

			return $this->response->created(
				app(UrlGenerator::class)
					->version('v1')
					->route('dataStreamPresetField.show', $dataStreamPresetField->id),
				$dataStreamPresetField);
		}

		return $this->response->errorBadRequest();
	}

	/**
	 * Update a data stream preset field
	 *
	 * @ApiDocsNoCall
	 *
	 * @param UpdateDataStreamPresetFieldRequest $request
	 * @param $dataStreamPresetFieldId string Data stream preset field UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function update(UpdateDataStreamPresetFieldRequest $request, $dataStreamPresetFieldId)
	{
		$dataStreamPresetField = DataStreamPresetField::find($dataStreamPresetFieldId);

		if (!$dataStreamPresetField)
			return $this->response->errorNotFound();

		$dataStreamPresetField->fill($request->all(), $request->getRealMethod());
		$dataStreamPresetField->save();

		return $this->response->item($dataStreamPresetField, new DataStreamPresetFieldTransformer);
	}

	/**
	 * Delete specified data stream preset field
	 **
	 * @ApiDocsNoCall
	 *
	 * @param $dataStreamPresetFieldId string Data stream preset field UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function destroy($dataStreamPresetFieldId)
	{
		$dataStreamPresetField = DataStreamPresetField::find($dataStreamPresetFieldId);

		if (!$dataStreamPresetField)
			return $this->response->errorNotFound();

		$dataStreamPresetField->delete();

		return $this->response->noContent();
	}
}
