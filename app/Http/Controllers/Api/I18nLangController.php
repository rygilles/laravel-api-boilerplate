<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\I18nLangTransformer;
use App\Models\I18nLang;
use Dingo\Api\Exception\ValidationHttpException;
use Dingo\Api\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * I18n Lang
 *
 * @package App\Http\Controllers\Api
 *
 * @Resource("I18nLang", uri="/i18nLang")
 */
class I18nLangController extends ApiController
{
	/**
	 * I18nLangController constructor.
	 */
	public function __construct()
	{

	}

	/**
	 * Show I18nLang list
	 *
	 * Get a JSON representation of all I18nLang.
	 *
	 * @param Request $request
	 * @return \Dingo\Api\Http\Response
	 * @Get(uri="/{?page,limit}")
	 * @Parameters({
	 *      @Parameter("page", description="The page of results to view.", default=1),
	 *      @Parameter("limit", description="The amount of results per page.", default=20)
	 * })
	 * @Request(headers={"Authorization": "Bearer xxx"})
	 * @Response(200, body={
	 *      "data": {
	 *          {
	 *              "id": "fr_FR",
	 *              "description": "French (France)"
	 *          },
	 *          {
	 *              "id": "en_US",
	 *              "description": "English (United States)"
	 *          }
	 *      },
	 *      "meta": {
	 *          "pagination": {
	 *              "total": 12,
	 *                "count": 2,
	 *                "per_page": 2,
	 *                "current_page": 3,
	 *                "total_pages": 6,
	 *                "links": {
	 *                  "previous": "https://domain.tld/api/user?page=2&limit=2",
	 *                  "next": "https://domain.tld/api/user?page=4&limit=2"
	 *              }
	 *          }
	 *      }
	 * })
	 */
	public function index(Request $request)
	{
		$i18nLangs = I18nLang::paginate();

		return $this->response->paginator($i18nLangs, new I18nLangTransformer);
	}

	/**
	 * Get specified I18n lang
	 *
	 * @param $i18nLangId int User UUID
	 * @return \Dingo\Api\Http\Response|void
	 *
	 * @Get(uri="/{i18nLangId}")
	 * @Parameters({
	 *      @Parameter("i18nLangId", type="string", required=true, description="I18n Lang ID"),
	 * })
	 * @Request(headers={"Authorization": "Bearer xxx"})
	 * @Response(200, body={
	 *      "data": {
	 *          "id": "ar_EG",
	 *          "description": "Arabic (Egypt)"
	 *      }
	 * })
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
	 * @param Request $request
	 * @return \Dingo\Api\Http\Response|void
	 * @throws ValidationHttpException
	 *
	 * @Post("/")
	 * @Request({"id": "foo", "description": "bar"}),
	 * @Response(201, body={
	 *      "user": {
	 *        "id": "foo",
	 *        "description": "bar"
	 *      }
	 * })
	 */
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), I18nLang::getStoreRules());

		if ($validator->fails()) {
			throw new ValidationHttpException($validator->errors());
		}

		$i18nLang = I18nLang::create($request->all());

		if ($i18nLang)
			return $this->response->created(app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('i18nLang.show', $i18nLang->id), $i18nLang);

		return $this->response->errorBadRequest();
	}

	/**
	 * Update a I18n lang
	 *
	 * @param Request $request
	 * @param $i18nLangId int User UUID
	 * @return \Dingo\Api\Http\Response|void
	 *
	 * @Put(uri="/{i18nLangId}")
	 * @Patch(uri="/{i18nLangId}")
	 * @Parameters({
	 *      @Parameter("i18nLangId", type="string", required=true, description="I18n Lang ID"),
	 * })
	 * @Request({"id": "foo", "description": "bar"}),
	 * @Response(201, body={
	 *      "user": {
	 *        "id": "foo",
	 *        "description": "bar"
	 *      }
	 * })
	 */
	public function update(Request $request, $i18nLangId)
	{
		$i18nLang = I18nLang::find($i18nLangId);

		if (!$i18nLang)
			return $this->response->errorNotFound();

		if ($request->getMethod() == 'PATCH')
			$validator = Validator::make($request->all(), I18nLang::getPatchRules());
		elseif ($request->getMethod() == 'PUT')
			$validator = Validator::make($request->all(), I18nLang::getPutRules());
		else
			$this->response->errorMethodNotAllowed();

		if ($validator->fails()) {
			throw new ValidationHttpException($validator->errors());
		}

		$i18nLang->fill($request->all());
		$i18nLang->save();
		// = I18nLang::update($request->all());

		return $this->response->item($i18nLang, new I18nLangTransformer);
	}
}
