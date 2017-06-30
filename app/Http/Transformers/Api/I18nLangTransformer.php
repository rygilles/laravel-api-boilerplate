<?php

namespace App\Http\Transformers\Api;

use App\Models\I18nLang;

class I18nLangTransformer extends ApiTransformer
{
	/**
	 * Turn this item object into a generic array
	 *
	 * @param I18nLang $i18nLang
	 * @return array
	 */
	public function transform(I18nLang $i18nLang)
	{
		return $this->filterWithModelConfiguration(
			I18nLang::class,
			[
				'id'            => $i18nLang->id,
				'description'   => $i18nLang->description
			]
		);
	}
}