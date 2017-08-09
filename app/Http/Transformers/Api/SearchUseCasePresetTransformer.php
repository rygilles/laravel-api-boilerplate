<?php

namespace App\Http\Transformers\Api;

use App\Models\SearchUseCasePreset;

class SearchUseCasePresetTransformer extends ApiTransformer
{
	/**
	 * Resources that can be included if requested.
	 *
	 * @var array
	 */
	protected $availableIncludes = [
		'dataStreamPreset',
	];

	/**
	 * Turn this item object into a generic array
	 *
	 * @param SearchUseCasePreset $searchUseCasePreset
	 * @return array
	 */
	public function transform(SearchUseCasePreset $searchUseCasePreset)
	{
		return $this->filterWithModelConfiguration(
			SearchUseCasePreset::class,
			[
				'id'                                    => $searchUseCasePreset->id,
				'data_stream_preset_id'                 => $searchUseCasePreset->data_stream_preset_id,
				'name'                                  => $searchUseCasePreset->name,
				'created_at'                            => $searchUseCasePreset->created_at->toDateTimeString(),
				'updated_at'                            => $searchUseCasePreset->updated_at->toDateTimeString(),
				'search_use_case_preset_fields_count'   => (int) $searchUseCasePreset->search_use_case_preset_fields_count,
			]
		);
	}

	/**
	 * Include dataStreamPreset
	 *
	 * @param SearchUseCasePreset $searchUseCasePreset
	 * @return League\Fractal\ItemResource
	 */
	public function includeDataStreamPreset(SearchUseCasePreset $searchUseCasePreset)
	{
		$dataStreamPreset = $searchUseCasePreset->dataStreamPreset;

		return $this->item($dataStreamPreset, new DataStreamPresetTransformer);
	}
}