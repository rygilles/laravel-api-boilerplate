<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\WidgetPresetTransformer;
use App\Models\DataStreamPreset;

/**
 * @resource WidgetPreset
 *
 * @package App\Http\Controllers\Api
 */
class DataStreamPresetWidgetPresetController extends ApiController
{
	/**
	 * DataStreamPresetWidgetPresetController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Data stream preset widget preset list
	 *
	 * (Through the related search use case presets)
	 *
	 * @param string $dataStreamPresetId Data stream preset UUID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index($dataStreamPresetId)
	{
		$dataStreamPreset = DataStreamPreset::find($dataStreamPresetId);

		if (!$dataStreamPreset)
			return $this->response->errorNotFound();

		$paginator = $dataStreamPreset->widgetPresets()
									  ->applyRequestQueryString()
									  ->paginate();

		return $this->response->paginator($paginator, new WidgetPresetTransformer);
	}
}
