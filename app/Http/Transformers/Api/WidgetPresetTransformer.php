<?php

namespace App\Http\Transformers\Api;

use App\Models\WidgetPreset;

class WidgetPresetTransformer extends ApiTransformer
{
	/**
	 * Resources that can be included if requested.
	 *
	 * @var array
	 */
	protected $availableIncludes = [
		'searchUseCasePreset',
	];

	/**
	 * Turn this item object into a generic array
	 *
	 * @param WidgetPreset $widgetPreset
	 * @return array
	 */
	public function transform(WidgetPreset $widgetPreset)
	{
		return $this->filterWithModelConfiguration(
			WidgetPreset::class,
			[
				'id'                        => $widgetPreset->id,
				'search_use_case_preset_id' => $widgetPreset->search_use_case_preset_id,
				'name'                      => $widgetPreset->name,
				'created_at'                => $widgetPreset->created_at->toDateTimeString(),
				'updated_at'                => $widgetPreset->updated_at->toDateTimeString()
			]
		);
	}

	/**
	 * Include searchUseCasePreset
	 *
	 * @param WidgetPreset $widgetPreset
	 * @return League\Fractal\ItemResource
	 */
	public function includeSearchUseCasePreset(WidgetPreset $widgetPreset)
	{
		$searchUseCasePreset = $widgetPreset->searchUseCasePreset;

		return $this->item($searchUseCasePreset, new SearchUseCasePresetTransformer);
	}
}