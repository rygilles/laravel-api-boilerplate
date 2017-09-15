<?php

namespace App\Http\Transformers\Api;

use App\Models\DataStream;

class DataStreamTransformer extends ApiTransformer
{
	/**
	 * Resources that can be included if requested.
	 *
	 * @var array
	 */
	protected $availableIncludes = [
		'project',
		'dataStreamDecoder'
	];

	/**
	 * Turn this item object into a generic array
	 *
	 * @param DataStream $dataStream
	 * @return array
	 */
	public function transform(DataStream $dataStream)
	{
		return $this->filterWithModelConfiguration(
			DataStream::class,
			[
				'id'                        => $dataStream->id,
				'data_stream_decoder_id'    => $dataStream->data_stream_decoder_id,
				'name'                      => $dataStream->name,
				'feed_url'                  => $dataStream->feed_url,
				'created_at'                => $dataStream->created_at->toDateTimeString(),
				'updated_at'                => $dataStream->updated_at->toDateTimeString()
			]
		);
	}

	/**
	 * Include project
	 *
	 * @param DataStream $dataStream
	 * @return League\Fractal\ItemResource
	 */
	public function includeProject(DataStream $dataStream)
	{
		$project = $dataStream->project;

		// Nullable foreign key
		if (is_null($project)) {
			 return null;
			//return $this->null();
		}

		return $this->item($project, new ProjectTransformer);
	}

	/**
	 * Include dataStreamDecoder
	 *
	 * @param DataStream $dataStream
	 * @return League\Fractal\ItemResource
	 */
	public function includeDataStreamDecoder(DataStream $dataStream)
	{
		$dataStreamDecoder = $dataStream->dataStreamDecoder;

		return $this->item($dataStreamDecoder, new DataStreamDecoderTransformer);
	}
}