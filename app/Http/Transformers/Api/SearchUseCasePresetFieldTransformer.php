<?php

namespace App\Http\Transformers\Api;

use App\Models\SearchUseCasePresetField;

class SearchUseCasePresetFieldTransformer extends ApiTransformer
{
	/**
	 * Resources that can be included if requested.
	 *
	 * @var array
	 */
	protected $availableIncludes = [
		'searchUseCasePreset',
		'dataStreamPresetField'
	];

	/**
	 * Turn this item object into a generic array
	 *
	 * @param SearchUseCasePresetField $searchUseCasePresetField
	 * @return array
	 */
	public function transform(SearchUseCasePresetField $searchUseCasePresetField)
	{
		return $this->filterWithModelConfiguration(
			SearchUseCasePresetField::class,
			[
				'search_use_case_preset_id'     => $searchUseCasePresetField->search_use_case_preset_id,
				'data_stream_preset_field_id'   => $searchUseCasePresetField->data_stream_preset_field_id,
				'name'                          => $searchUseCasePresetField->name,
				'searchable'                    => $searchUseCasePresetField->searchable,
				'to_retrieve'                   => $searchUseCasePresetField->to_retrieve,
				'created_at'                    => $searchUseCasePresetField->created_at->toDateTimeString(),
				'updated_at'                    => $searchUseCasePresetField->updated_at->toDateTimeString()
			]
		);
	}

	/**
	 * Include SearchUseCasePreset
	 *
	 * @param SearchUseCasePresetField $searchUseCasePresetField
	 * @return League\Fractal\ItemResource
	 */
	public function includeSearchUseCase(SearchUseCasePresetField $searchUseCasePresetField)
	{
		$searchUseCasePreset = $searchUseCasePresetField->searchUseCasePreset;

		return $this->item($searchUseCasePreset, new SearchUseCaseTransformer);
	}

	/**
	 * Include dataStreamPresetField
	 *
	 * @param SearchUseCasePresetField $searchUseCasePresetField
	 * @return League\Fractal\ItemResource
	 */
	public function includeDataStreamPresetField(SearchUseCasePresetField $searchUseCasePresetField)
	{
		$dataStreamPresetField = $searchUseCasePresetField->dataStreamPresetField;

		return $this->item($dataStreamPresetField, new DataStreamPresetFieldTransformer);
	}
}