<?php

namespace App\Http\Transformers\Api;

use App\Models\Widget;

class WidgetTransformer extends ApiTransformer
{
	/**
	 * Resources that can be included if requested.
	 *
	 * @var array
	 */
	protected $availableIncludes = [
		'searchUseCase',
	];

	/**
	 * Turn this item object into a generic array
	 *
	 * @param Widget $widget
	 * @return array
	 */
	public function transform(Widget $widget)
	{
		return $this->filterWithModelConfiguration(
			Widget::class,
			[
				'id'                    => $widget->id,
				'search_use_case_id'    => $widget->search_use_case_id,
				'name'                  => $widget->name,
				'created_at'            => $widget->created_at->toDateTimeString(),
				'updated_at'            => $widget->updated_at->toDateTimeString()
			]
		);
	}

	/**
	 * Include searchUseCase
	 *
	 * @param Widget $widget
	 * @return League\Fractal\ItemResource
	 */
	public function includeSearchUseCase(Widget $widget)
	{
		$searchUseCase = $widget->searchUseCase;

		return $this->item($searchUseCase, new SearchUseCaseTransformer);
	}
}