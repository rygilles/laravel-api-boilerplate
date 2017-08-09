<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreDataStreamHasI18nLangRequest;
use App\Http\Requests\UpdateDataStreamHasI18nLangRequest;
use App\Http\Transformers\Api\DataStreamHasI18nLangTransformer;
use App\Models\DataStreamHasI18nLang;
use Dingo\Api\Exception\ValidationHttpException;
use Illuminate\Support\Facades\Lang;

/**
 * @resource DataStreamHasI18nLang
 * @todo Security ?
 * @package App\Http\Controllers\Api
 */
class DataStreamHasI18nLangController extends ApiController
{
	/**
	 * DataStreamHasI18nLangController constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		// User group restrictions
		$this->middleware('verifyUserGroup:Developer,Support', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
	}

	/**
	 * List of relationships between data streams and i18n langs
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function index()
	{
		$paginator = DataStreamHasI18nLang::paginate();

		return $this->response->paginator($paginator, new DataStreamHasI18nLangTransformer);
	}

	/**
	 * Get specified relationship between a data stream and a i18n lang
	 *
	 * @param $dataStreamId string Data Stream UUID
	 * @param $i18nLangId string I18n Land Id
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function show($dataStreamId, $i18nLangId)
	{
		$dataStreamHasI18nLang = DataStreamHasI18nLang::where('data_stream_id', $dataStreamId)->where('i18n_lang_id', $i18nLangId)->get();

		if (!$dataStreamHasI18nLang)
			return $this->response->errorNotFound();

		return $this->response->item($dataStreamHasI18nLang, new DataStreamHasI18nLangTransformer);
	}

	/**
	 * Create and store new relationship between a data stream and a i18n lang
	 *
	 * <aside class="notice">Only one relationship per data stream/i18n lang is allowed.</aside>
	 *
	 * @ApiDocsNoCall
	 *
	 * @param StoreDataStreamHasI18nLangRequest $request
	 * @return \Dingo\Api\Http\Response|void
	 * @throws ValidationHttpException
	 */
	public function store(StoreDataStreamHasI18nLangRequest $request)
	{
		// Check if a relationship between the specified data stream and i18n lang already exists.
		if (DataStreamHasI18nLang::where('data_stream_id', $request->input('data_stream_id'))->where('i18n_lang_id', $request->input('i18n_lang_id'))->exists()) {
			return $this->response->errorBadRequest(Lang::get('errors.data_stream_i18n_lang_relationship_exists'));
		}

		$dataStreamHasI18nLang = DataStreamHasI18nLang::create($request->all(), $request->getRealMethod());

		if ($dataStreamHasI18nLang) {
			// Register model transformer for created/accepted responses
			// @link https://github.com/dingo/api/issues/1218
			app('Dingo\Api\Transformer\Factory')->register(
				DataStreamHasI18nLang::class,
				DataStreamHasI18nLangTransformer::class
			);

			return $this->response->created(
				app('Dingo\Api\Routing\UrlGenerator')
					->version('v1')
					->route('dataStreamHasI18nLang.show', [$dataStreamHasI18nLang->data_stream_id, $dataStreamHasI18nLang->i18n_lang_id]), $dataStreamHasI18nLang
			);
		}

		return $this->response->errorBadRequest();
	}

	/**
	 * Update a specified relationship between a data stream and a i18n lang
	 *
	 * <aside class="notice">Only one relationship per data stream/i18n lang is allowed.</aside>
	 *
	 * @ApiDocsNoCall
	 *
	 * @param UpdateDataStreamHasI18nLangRequest $request
	 * @param $dataStreamId string Data Stream UUID
	 * @param $i18nLangId string I18n Land Id
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function update(UpdateDataStreamHasI18nLangRequest $request, $dataStreamId, $i18nLangId)
	{
		$dataStreamHasI18nLang = DataStreamHasI18nLang::where('data_stream_id', $dataStreamId)->where('i18n_lang_id', $i18nLangId)->first();

		if (!$dataStreamHasI18nLang)
			return $this->response->errorNotFound();

		// Check if a relationship between the specified data stream and i18n lang already exists (ignoring the current if not changed).
		if (($dataStreamId != $request->input('data_stream_id')) || ($i18nLangId != $request->input('i18n_lang_id'))) {
			if (DataStreamHasI18nLang::where('data_stream_id', $request->input('data_stream_id'))->where('i18n_lang_id', $request->input('i18n_lang_id'))->exists()) {
				return $this->response->errorBadRequest(Lang::get('errors.data_stream_i18n_lang_relationship_exists'));
			}
		}

		$data_stream_id = ($request->has('data_stream_id') ? $request->input('data_stream_id') : $dataStreamId);
		$i18n_lang_id =  ($request->has('i18n_lang_id') ? $request->input('i18n_lang_id') : $i18nLangId);

		DataStreamHasI18nLang::where('data_stream_id', $dataStreamId)->where('i18n_lang_id', $i18nLangId)->update([
			'data_stream_id'  => $data_stream_id,
			'i18n_lang_id'    => $i18n_lang_id,
		]);

		$dataStreamHasI18nLang = DataStreamHasI18nLang::where('data_stream_id', $data_stream_id)
													  ->where('i18n_lang_id', $i18n_lang_id)->first();

		return $this->response->item($dataStreamHasI18nLang, new DataStreamHasI18nLangTransformer);
	}

	/**
	 * Delete specified relationship between a data stream and a i18n lang
	 *
	 * @ApiDocsNoCall
	 *
	 * @param $dataStreamId string Data Stream UUID
	 * @param $i18nLangId string I18n Land Id
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function destroy($dataStreamId, $i18nLangId)
	{
		if (!DataStreamHasI18nLang::where('data_stream_id', $dataStreamId)->where('i18n_lang_id', $i18nLangId)->exists()) {
			return $this->response->errorNotFound();
		}

		DataStreamHasI18nLang::where('data_stream_id', $dataStreamId)->where('i18n_lang_id', $i18nLangId)->delete();

		return $this->response->noContent();
	}
}
