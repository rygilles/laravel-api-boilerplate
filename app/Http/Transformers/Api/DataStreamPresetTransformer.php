<?php

namespace App\Http\Transformers\Api;

use App\Models\DataStreamPreset;

class DataStreamPresetTransformer extends ApiTransformer
{
	/**
	 * Resources that can be included if requested.
	 *
	 * @var array
	 */
	protected $availableIncludes = [
		'dataStreamDecoder'
	];

	/**
	 * Turn this item object into a generic array
	 *
	 * @param DataStreamPreset $dataStreamPreset
	 * @return array
	 */
	public function transform(DataStreamPreset $dataStreamPreset)
	{
		return $this->filterWithModelConfiguration(
			DataStreamPreset::class,
			[
				'id'                        => $dataStreamPreset->id,
				'data_stream_decoder_id'    => $dataStreamPreset->data_stream_decoder_id,
				'name'                      => $dataStreamPreset->name,
				'created_at'                => $dataStreamPreset->created_at->toDateTimeString(),
				'updated_at'                => $dataStreamPreset->updated_at->toDateTimeString()
			]
		);
	}

	/**
	 * Include DataStreamDecoder
	 *
	 * @param DataStreamPreset $dataStreamPreset
	 * @return League\Fractal\ItemResource
	 */
	public function includeDataStreamDecoder(DataStreamPreset $dataStreamPreset)
	{
		$dataStreamDecoder = $dataStreamPreset->dataStreamDecoder;

		return $this->item($dataStreamDecoder, new DataStreamDecoderTransformer);
	}
}