<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreSearchUseCaseFieldRequest;
use App\Http\Requests\UpdateSearchUseCaseFieldRequest;
use App\Http\Transformers\Api\SearchUseCaseFieldTransformer;
use App\Models\SearchUseCaseField;

/**
 * @resource SearchUseCaseField
 *
 * @package App\Http\Controllers\Api
 */
class SearchUseCaseFieldController extends ApiController
{
	/**
	 * SearchUseCaseFieldController constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		// User group restrictions
		$this->middleware('verifyUserGroup:Developer,Support',  ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
	}

	/**
	 * Show search use case field list
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function index()
	{
		$searchUseCaseFields = SearchUseCaseField::applyRequestQueryString()
												 ->paginate();

		return $this->response->paginator($searchUseCaseFields, new SearchUseCaseFieldTransformer);
	}

	/**
	 * Get specified search use case field
	 *
	 * @param $searchUseCaseId string Search use case UUID
	 * @param $dataStreamFieldId string Data stream field UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function show($searchUseCaseId, $dataStreamFieldId)
	{
		$searchUseCaseField = SearchUseCaseField::where('search_use_case_id', $searchUseCaseId)
												->where('data_stream_field_id', $dataStreamFieldId)->get();

		if (!$searchUseCaseField)
			return $this->response->errorNotFound();

		return $this->response->item($searchUseCaseField, new SearchUseCaseFieldTransformer);
	}

	/**
	 * Create and store new search use case field
	 *
	 * @ApiDocsNoCall
	 *
	 * @param StoreSearchUseCaseFieldRequest $request
	 * @return \Dingo\Api\Http\Response|void
	 * @throws ValidationHttpException
	 */
	public function store(StoreSearchUseCaseFieldRequest $request)
	{
		// Check if a relationship between the specified search use case and data stream field already exists.
		if (SearchUseCaseField::where('search_use_case_id', $request->input('search_use_case_id'))
							  ->where('data_stream_field_id', $request->input('data_stream_field_id'))->exists()) {
			return $this->response->errorBadRequest(Lang::get('errors.search_use_case_field_exists'));
		}

		$searchUseCaseField = SearchUseCaseField::create($request->all(), $request->getRealMethod());

		if ($searchUseCaseField) {
			// Register model transformer for created/accepted responses
			// @link https://github.com/dingo/api/issues/1218
			app('Dingo\Api\Transformer\Factory')->register(
				SearchUseCaseField::class,
				SearchUseCaseFieldTransformer::class
			);

			return $this->response->created(
				app('Dingo\Api\Routing\UrlGenerator')
					->version('v1')
					->route('searchUseCaseField.show', [$searchUseCaseField->search_use_case_id,
														$searchUseCaseField->data_stream_field_id]), $searchUseCaseField
			);
		}

		return $this->response->errorBadRequest();
	}

	/**
	 * Update a specified search use case field
	 *
	 * @ApiDocsNoCall
	 *
	 * @param UpdateSearchUseCaseFieldRequest $request
	 * @param $searchUseCaseId string Search use case UUID
	 * @param $dataStreamFieldId string Data stream field UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function update(UpdateSearchUseCaseFieldRequest $request, $searchUseCaseId, $dataStreamFieldId)
	{
		$searchUseCaseField = SearchUseCaseField::where('search_use_case_id', $searchUseCaseId)
												->where('data_stream_field_id', $dataStreamFieldId)->get();

		if (!$searchUseCaseField)
			return $this->response->errorNotFound();

		// Check if a relationship between the specified user and project already exists (ignoring the current if not changed).
		if (($searchUseCaseId != $request->input('search_use_case_id')) || ($dataStreamFieldId != $request->input('data_stream_field_id'))) {
			if (SearchUseCaseField::where('search_use_case_id', $request->input('search_use_case_id'))
								  ->where('data_stream_field_id', $request->input('data_stream_field_id'))->exists()) {
				return $this->response->errorBadRequest(Lang::get('errors.search_use_case_field_exists'));
			}
		}

		SearchUseCaseField::where('search_use_case_id', $searchUseCaseId)->where('data_stream_field_id', $dataStreamFieldId)->update([
			'search_use_case_id'      => $request->input('search_use_case_id'),
			'data_stream_field_id'    => $request->input('data_stream_field_id'),
			'name'                    => $request->input('name'),
			'searchable'              => $request->input('searchable'),
			'to_retrieve'             => $request->input('to_retrieve'),
		]);

		$searchUseCaseField = SearchUseCaseField::where('search_use_case_id', $searchUseCaseId)
												->where('data_stream_field_id', $dataStreamFieldId)->first();

		return $this->response->item($searchUseCaseField, new SearchUseCaseFieldTransformer);
	}

	/**
	 * Delete specified search use case field
	 *
	 * @ApiDocsNoCall
	 *
	 * @param $searchUseCaseId string Search use case UUID
	 * @param $dataStreamFieldId string Data stream field UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function destroy($searchUseCaseId, $dataStreamFieldId)
	{
		if (!SearchUseCaseField::where('search_use_case_id', $searchUseCaseId)
					           ->where('data_stream_field_id', $dataStreamFieldId)->exists()) {
			return $this->response->errorNotFound();
		}

		SearchUseCaseField::where('search_use_case_id', $searchUseCaseId)
						  ->where('data_stream_field_id', $dataStreamFieldId)->delete();

		return $this->response->noContent();
	}
}
