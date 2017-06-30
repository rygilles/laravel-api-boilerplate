<?php

namespace App\Http\Transformers\Api;

use App\Models\DataStreamPresetField;

class DataStreamPresetFieldTransformer extends ApiTransformer
{
	/**
	 * Resources that can be included if requested.
	 *
	 * @var array
	 */
	protected $availableIncludes = [
		'dataStreamPreset'
	];

	/**
	 * Turn this item object into a generic array
	 *
	 * @param DataStreamPresetField $dataStreamPresetField
	 * @return array
	 */
	public function transform(DataStreamPresetField $dataStreamPresetField)
	{
		return $this->filterWithModelConfiguration(
			DataStreamPresetField::class,
			[
				'id'                        => $dataStreamPresetField->id,
				'data_stream_preset_id'     => $dataStreamPresetField->data_stream_preset_id,
				'name'                      => $dataStreamPresetField->name,
				'path'                      => $dataStreamPresetField->path,
				'versioned'                 => (boolean) $dataStreamPresetField->versioned,
				'searchable'                => (boolean) $dataStreamPresetField->searchable,
				'to_retrieve'               => (boolean) $dataStreamPresetField->to_retrieve,
				'created_at'                => $dataStreamPresetField->created_at->toDateTimeString(),
				'updated_at'                => $dataStreamPresetField->updated_at->toDateTimeString()
			]
		);
	}

	/**
	 * Include DataStreamPreset
	 *
	 * @param DataStreamPresetField $dataStreamPresetField
	 * @return League\Fractal\ItemResource
	 */
	public function includeDataStreamPreset(DataStreamPresetField $dataStreamPresetField)
	{
		$dataStreamPreset = $dataStreamPresetField->dataStreamPreset;

		return $this->item($dataStreamPreset, new DataStreamPresetTransformer);
	}
}