<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreWidgetRequest;
use App\Http\Requests\UpdateWidgetRequest;
use App\Http\Transformers\Api\WidgetTransformer;
use App\Models\Widget;

/**
 * @resource Widget
 * @OpenApiOperationTag Manager:Widget
 *
 * @package App\Http\Controllers\Api
 */
class WidgetController extends ApiController
{
	/**
	 * WidgetController constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		// User group restrictions
		$this->middleware('verifyUserGroup:Developer,Support',  ['only' => ['index']]);
	}

	/**
	 * Show widget list
	 *
	 * @OpenApiOperationId all
	 * @OpenApiResponseSchemaRef #/components/schemas/WidgetListResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A Widget list
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
		// @todo ->withCount('widgetIntegrations') ?
		$widgets = Widget::applyRequestQueryString()
						 ->paginate();

		return $this->response->paginator($widgets, new WidgetTransformer);
	}

	/**
	 * Get specified widget
	 *
	 * @OpenApiOperationId get
	 * @OpenApiResponseSchemaRef #/components/schemas/WidgetResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A Widget
	 * @OpenApiExtraParameterRef #/components/parameters/Include
	 *
	 * @param string $widgetId Widget UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function show($widgetId)
	{
		// @todo ->withCount('widgetIntegrations') ?
		$widget = Widget::authorized(['Owner', 'Administrator'])
						->find($widgetId);

		if (!$widget)
			return $this->response->errorNotFound();

		return $this->response->item($widget, new WidgetTransformer);
	}

	/**
	 * Create and store new widget
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId create
	 * @OpenApiResponseSchemaRef #/components/schemas/WidgetResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A Widget
	 *
	 * @param StoreWidgetRequest $request
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function store(StoreWidgetRequest $request)
	{
		$widget = Widget::authorized(['Owner', 'Administrator'])
						->create($request->all(), $request->getRealMethod());

		if ($widget) {
			// Register model transformer for created/accepted responses
			// @link https://github.com/dingo/api/issues/1218
			app('Dingo\Api\Transformer\Factory')->register(
				Widget::class,
				WidgetTransformer::class
			);

			return $this->response->created(
				app('Dingo\Api\Routing\UrlGenerator')
					->version('v1')
					->route('widget.show', $widget->id),
				$widget);
		}

		return $this->response->errorBadRequest();
	}

	/**
	 * Update a widget
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId update
	 * @OpenApiOperationTag Resource:Widget
	 * @OpenApiResponseSchemaRef #/components/schemas/WidgetResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription The updated Widget
	 *
	 * @param UpdateWidgetRequest $request
	 * @param string $widgetId Widget UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function update(UpdateWidgetRequest $request, $widgetId)
	{
		$widget = Widget::authorized(['Owner', 'Administrator'])
							   ->find($widgetId);

		if (!$widget)
			return $this->response->errorNotFound();

		$widget->fill($request->all(), $request->getRealMethod());
		$widget->save();

		return $this->response->item($widget, new WidgetTransformer);
	}

	/**
	 * Delete specified widget
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId delete
	 * @OpenApiOperationTag Resource:Widget
	 * @OpenApiResponseDescription Empty response
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 *
	 * @param string $widgetId Widget UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function destroy($widgetId)
	{
		$widget = Widget::authorized(['Owner', 'Administrator'])
						->find($widgetId);

		if (!$widget)
			return $this->response->errorNotFound();

		$widget->delete();

		return $this->response->noContent();
	}
}
