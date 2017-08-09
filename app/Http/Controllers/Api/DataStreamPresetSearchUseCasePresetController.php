<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\SearchUseCasePresetTransformer;
use App\Models\DataStreamPreset;

/**
 * @resource SearchUseCasePreset
 *
 * @package App\Http\Controllers\Api
 */
class DataStreamPresetSearchUseCasePresetController extends ApiController
{
	/**
	 * DataStreamPresetSearchUseCasePresetController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Data stream preset search use case preset list
	 *
	 * @param string $dataStreamPresetId Data stream preset UUID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index($dataStreamPresetId)
	{
		$dataStreamPreset = DataStreamPreset::find($dataStreamPresetId);

		if (!$dataStreamPreset)
			return $this->response->errorNotFound();

		$paginator = $dataStreamPreset->searchUseCasePresets()
									  ->applyRequestQueryString()
									  ->paginate();

		return $this->response->paginator($paginator, new SearchUseCasePresetTransformer);
	}
}
