<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreI18nLangRequest;
use App\Http\Requests\UpdateI18nLangRequest;
use App\Http\Transformers\Api\I18nLangTransformer;
use App\Models\I18nLang;
use Dingo\Api\Exception\ValidationHttpException;

/**
 * @resource I18nLang
 *
 * @package App\Http\Controllers\Api
 */
class I18nLangController extends ApiController
{
	/**
	 * I18nLangController constructor.
	 */
	public function __construct()
	{
		// User group restrictions
		$this->middleware('verifyUserGroup:Developer,Support')->only('store,update');
	}

	/**
	 * Show I18nLang list
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function index()
	{
		$i18nLangs = I18nLang::paginate();

		return $this->response->paginator($i18nLangs, new I18nLangTransformer);
	}

	/**
	 * Get specified I18n lang
	 *
	 * @param $i18nLangId string User UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function show($i18nLangId)
	{
		$i18nLang = I18nLang::find($i18nLangId);

		if (!$i18nLang)
			return $this->response->errorNotFound();

		return $this->response->item($i18nLang, new I18nLangTransformer);
	}

	/**
	 * Create and store new I18n lang
	 *
	 * @param StoreI18nLangRequest $request
	 * @return \Dingo\Api\Http\Response|void
	 * @throws ValidationHttpException
	 */
	public function store(StoreI18nLangRequest $request)
	{
		$i18nLang = I18nLang::create($request->all());

		if ($i18nLang)
			return $this->response->created(app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('i18nLang.show', $i18nLang->id), $i18nLang);

		return $this->response->errorBadRequest();
	}

	/**
	 * Update a I18n lang
	 *
	 * @param UpdateI18nLangRequest $request
	 * @param $i18nLangId int User UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function update(UpdateI18nLangRequest $request, $i18nLangId)
	{
		$i18nLang = I18nLang::find($i18nLangId);

		if (!$i18nLang)
			return $this->response->errorNotFound();

		$i18nLang->fill($request->all());
		$i18nLang->save();

		return $this->response->item($i18nLang, new I18nLangTransformer);
	}
}
