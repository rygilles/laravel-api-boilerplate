<?php

namespace App\Http\Transformers\Api;

use App\Models\DataStreamDecoder;

class DataStreamDecoderTransformer extends ApiTransformer
{
	/**
	 * Turn this item object into a generic array
	 *
	 * @param DataStreamDecoder $dataStreamDecoder
	 * @return array
	 */
	public function transform(DataStreamDecoder $dataStreamDecoder)
	{
		return $this->filterWithModelConfiguration(
			DataStreamDecoder::class,
			[
				'id'                => $dataStreamDecoder->id,
				'name'              => $dataStreamDecoder->name,
				'class_name'        => $dataStreamDecoder->class_name,
				'file_mime_type'    => $dataStreamDecoder->file_mime_type,
				'created_at'        => $dataStreamDecoder->created_at->toDateTimeString(),
				'updated_at'        => $dataStreamDecoder->updated_at->toDateTimeString()
			]
		);
	}
}