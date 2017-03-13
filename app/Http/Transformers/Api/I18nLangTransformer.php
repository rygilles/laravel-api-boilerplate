<?php

namespace App\Http\Transformers\Api;

use League\Fractal\TransformerAbstract;
use App\Models\I18nLang;

class I18nLangTransformer extends TransformerAbstract
{
	/**
	 * Turn this item object into a generic array
	 *
	 * @param I18nLang $i18nLang
	 * @return array
	 */
	public function transform(I18nLang $i18nLang)
	{
		return [
			'id'            => $i18nLang->id,
			'description'   => $i18nLang->description
		];
	}
}