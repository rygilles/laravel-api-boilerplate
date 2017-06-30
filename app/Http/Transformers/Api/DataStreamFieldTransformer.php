<?php

namespace App\Http\Transformers\Api;

use App\Models\DataStreamField;

class DataStreamFieldTransformer extends ApiTransformer
{
	/**
	 * Resources that can be included if requested.
	 *
	 * @var array
	 */
	protected $availableIncludes = [
		'dataStream'
	];

	/**
	 * Turn this item object into a generic array
	 *
	 * @param DataStreamField $dataStreamField
	 * @return array
	 */
	public function transform(DataStreamField $dataStreamField)
	{
		return $this->filterWithModelConfiguration(
			DataStreamField::class,
			[
				'id'                        => $dataStreamField->id,
				'data_stream_id'            => $dataStreamField->data_stream_id,
				'name'                      => $dataStreamField->name,
				'path'                      => $dataStreamField->path,
				'versioned'                 => (boolean) $dataStreamField->versioned,
				'searchable'                => (boolean) $dataStreamField->searchable,
				'to_retrieve'               => (boolean) $dataStreamField->to_retrieve,
				'created_at'                => $dataStreamField->created_at->toDateTimeString(),
				'updated_at'                => $dataStreamField->updated_at->toDateTimeString()
			]
		);
	}

	/**
	 * Include DataStream
	 *
	 * @param DataStreamField $dataStreamField
	 * @return League\Fractal\ItemResource
	 */
	public function includeDataStream(DataStreamField $dataStreamField)
	{
		$dataStream = $dataStreamField->dataStream;

		return $this->item($dataStream, new DataStreamTransformer);
	}
}