<?php

namespace App\Http\Transformers\Api;

use App\Models\DataStreamHasI18nLang;

class DataStreamHasI18nLangTransformer extends ApiTransformer
{
	/**
	 * Resources that can be included if requested.
	 *
	 * @var array
	 */
	protected $availableIncludes = [
		'dataStream',
		'i18nLang'
	];

	/**
	 * Turn this item object into a generic array
	 *
	 * @param DataStreamHasI18nLang $dataStreamHasI18nLang
	 * @return array
	 */
	public function transform(DataStreamHasI18nLang $dataStreamHasI18nLang)
	{
		return $this->filterWithModelConfiguration(
			DataStreamHasI18nLang::class,
			[
				'data_stream_id'    => $dataStreamHasI18nLang->data_stream_id,
				'i18n_lang_id'      => $dataStreamHasI18nLang->i18n_lang_id,
				'created_at'        => $dataStreamHasI18nLang->created_at->toDateTimeString(),
				'updated_at'        => $dataStreamHasI18nLang->updated_at->toDateTimeString()
			]
		);
	}

	/**
	 * Include dataStream
	 *
	 * @param DataStreamHasI18nLang $dataStreamHasI18nLang
	 * @return League\Fractal\ItemResource
	 */
	public function includeDataStream(DataStreamHasI18nLang $dataStreamHasI18nLang)
	{
		$dataStream = $dataStreamHasI18nLang->dataStream;

		return $this->item($dataStream, new DataStreamTransformer);
	}

	/**
	 * Include i18nLag
	 *
	 * @param DataStreamHasI18nLang $dataStreamHasI18nLang
	 * @return League\Fractal\ItemResource
	 */
	public function includeI18nLang(DataStreamHasI18nLang $dataStreamHasI18nLang)
	{
		$i18nLang = $dataStreamHasI18nLang->i18nLang;

		return $this->item($i18nLang, new I18nLangTransformer);
	}
}