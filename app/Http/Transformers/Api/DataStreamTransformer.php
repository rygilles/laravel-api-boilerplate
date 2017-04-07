<?php

namespace App\Http\Transformers\Api;

use League\Fractal\TransformerAbstract;
use App\Models\DataStream;

class DataStreamTransformer extends ApiTransformer
{
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
				'id'            => $dataStream->id,
				'name'          => $dataStream->name,
				'feed_url'      => $dataStream->feed_url,
				'created_at'    => $dataStream->created_at->toDateTimeString(),
				'updated_at'    => $dataStream->updated_at->toDateTimeString()
			]
		);
	}
}