<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\SyncTaskTypeVersionTransformer;
use App\Models\I18nLang;

/**
 * @resource SyncTaskTypeVersion
 *
 * @package App\Http\Controllers\Api
 */
class I18nLangSyncTaskTypeVersionController extends ApiController
{
	/**
	 * I18n lang sync task type versions list
	 *
	 * @param string $i18nLangId I18n Lang ID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index($i18nLangId)
	{
		$i18nLang = I18nLang::find($i18nLangId);

		if (!$i18nLang)
			return $this->response->errorNotFound();

		$paginator = $i18nLang->syncTaskTypeVersions()->paginate();

		return $this->response->paginator($paginator, new SyncTaskTypeVersionTransformer);
	}
}
