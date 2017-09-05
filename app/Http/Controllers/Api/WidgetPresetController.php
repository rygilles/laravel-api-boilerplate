<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreWidgetPresetRequest;
use App\Http\Requests\UpdateWidgetPresetRequest;
use App\Http\Transformers\Api\WidgetPresetTransformer;
use App\Models\WidgetPreset;

/**
 * @resource WidgetPreset
 *
 * @package App\Http\Controllers\Api
 */
class WidgetPresetController extends ApiController
{
	/**
	 * WidgetPresetController constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		// User group restrictions
		$this->middleware('verifyUserGroup:Developer,Support', ['only' => ['store', 'update', 'destroy']]);
	}

	/**
	 * Show widget preset list
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function index()
	{
		// @todo ->withCount('widgetPresetIntegrations') ?
		$widgetPresets = WidgetPreset::applyRequestQueryString()
									 ->paginate();

		return $this->response->paginator($widgetPresets, new WidgetPresetTransformer);
	}

	/**
	 * Get specified widget preset
	 *
	 * @param string $widgetPresetId Widget preset UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function show($widgetPresetId)
	{
		// @todo ->withCount('widgetPresetIntegrations') ?
		$widgetPreset = WidgetPreset::find($widgetPresetId);

		if (!$widgetPreset)
			return $this->response->errorNotFound();

		return $this->response->item($widgetPreset, new WidgetPresetTransformer);
	}

	/**
	 * Create and store new widget preset
	 *
	 * @ApiDocsNoCall
	 *
	 * @param StoreWidgetPresetRequest $request
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function store(StoreWidgetPresetRequest $request)
	{
		$widgetPreset = WidgetPreset::create($request->all(), $request->getRealMethod());

		if ($widgetPreset) {
			// Register model transformer for created/accepted responses
			// @link https://github.com/dingo/api/issues/1218
			app('Dingo\Api\Transformer\Factory')->register(
				WidgetPreset::class,
				WidgetPresetTransformer::class
			);

			return $this->response->created(
				app('Dingo\Api\Routing\UrlGenerator')
					->version('v1')
					->route('widgetPreset.show', $widgetPreset->id),
				$widgetPreset);
		}

		return $this->response->errorBadRequest();
	}

	/**
	 * Update a widget preset
	 *
	 * @ApiDocsNoCall
	 *
	 * @param UpdateWidgetPresetRequest $request
	 * @param string $widgetPresetId Widget preset UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function update(UpdateWidgetPresetRequest $request, $widgetPresetId)
	{
		$widgetPreset = WidgetPreset::find($widgetPresetId);

		if (!$widgetPreset)
			return $this->response->errorNotFound();

		$widgetPreset->fill($request->all(), $request->getRealMethod());
		$widgetPreset->save();

		return $this->response->item($widgetPreset, new WidgetPresetTransformer);
	}

	/**
	 * Delete specified widget preset
	 *
	 * @ApiDocsNoCall
	 *
	 * @param string $widgetPresetId Widget preset UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function destroy($widgetPresetId)
	{
		$widgetPreset = WidgetPreset::find($widgetPresetId);

		if (!$widgetPreset)
			return $this->response->errorNotFound();

		$widgetPreset->delete();

		return $this->response->noContent();
	}
}
