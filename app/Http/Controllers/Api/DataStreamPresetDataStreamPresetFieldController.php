<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\DataStreamPresetFieldTransformer;
use App\Models\DataStreamPreset;

/**
 * @resource DataStreamPresetField
 *
 * @package App\Http\Controllers\Api
 */
class DataStreamPresetDataStreamPresetFieldController extends ApiController
{
	/**
	 * DataStreamPresetDataStreamPresetFieldController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Data stream preset data stream preset field list
	 *	 *
	 * @param string $dataStreamPresetId Data stream preset UUID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index($dataStreamPresetId)
	{
		$dataStreamPreset = DataStreamPreset::find($dataStreamPresetId);

		if (!$dataStreamPreset)
			return $this->response->errorNotFound();

		$paginator = $dataStreamPreset->dataStreamPresetFields()
									  ->applyRequestQueryString()
									  ->paginate();

		return $this->response->paginator($paginator, new DataStreamPresetFieldTransformer);
	}
}
