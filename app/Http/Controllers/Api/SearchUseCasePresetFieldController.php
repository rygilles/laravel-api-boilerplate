<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreSearchUseCasePresetFieldRequest;
use App\Http\Requests\UpdateSearchUseCasePresetFieldRequest;
use App\Http\Transformers\Api\SearchUseCasePresetFieldTransformer;
use App\Models\SearchUseCasePresetField;

/**
 * @resource SearchUseCasePresetField
 * @OpenApiOperationTag Manager:SearchUseCasePresetField
 *
 * @package App\Http\Controllers\Api
 */
class SearchUseCasePresetFieldController extends ApiController
{
	/**
	 * SearchUseCasePresetFieldController constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		// User group restrictions
		$this->middleware('verifyUserGroup:Developer,Support',  ['only' => ['store', 'update', 'destroy']]);
	}

	/**
	 * Show search use case preset field list
	 *
	 * @OpenApiOperationId all
	 * @OpenApiResponseSchemaRef #/components/schemas/SearchUseCasePresetFieldListResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A SearchUseCasePresetField list
	 * @OpenApiExtraParameterRef #/components/parameters/Include
	 * @OpenApiExtraParameterRef #/components/parameters/Search
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationPage
	 * @OpenApiExtraParameterRef #/components/parameters/PaginationLimit
	 * @OpenApiExtraParameterRef #/components/parameters/OrderBy
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function index()
	{
		$searchUseCasePresetFields = SearchUseCasePresetField::applyRequestQueryString()
												             ->paginate();

		return $this->response->paginator($searchUseCasePresetFields, new SearchUseCasePresetFieldTransformer);
	}

	/**
	 * Get specified search use case preset field
	 *
	 * @OpenApiOperationId get
	 * @OpenApiResponseSchemaRef #/components/schemas/SearchUseCasePresetFieldResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription A SearchUseCasePresetField
	 * @OpenApiExtraParameterRef #/components/parameters/Include
	 *
	 * @param string $searchUseCasePresetId Search use case preset UUID
	 * @param string $dataStreamPresetFieldId Data stream preset field UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function show($searchUseCasePresetId, $dataStreamPresetFieldId)
	{
		$searchUseCasePresetField = SearchUseCasePresetField::where('search_use_case_preset_id', $searchUseCasePresetId)
													        ->where('data_stream_preset_field_id', $dataStreamPresetFieldId)->first();

		if (!$searchUseCasePresetField)
			return $this->response->errorNotFound();

		return $this->response->item($searchUseCasePresetField, new SearchUseCasePresetFieldTransformer);
	}

	/**
	 * Create and store new search use case preset field
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId create
	 * @OpenApiResponseSchemaRef #/components/schemas/SearchUseCasePresetFieldResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription The created SearchUseCasePresetField
	 *
	 * @param StoreSearchUseCasePresetFieldRequest $request
	 * @return \Dingo\Api\Http\Response|void
	 * @throws ValidationHttpException
	 */
	public function store(StoreSearchUseCasePresetFieldRequest $request)
	{
		// Check if a relationship between the specified search use case preset and data stream preset field already exists.
		if (SearchUseCasePresetField::where('search_use_case_preset_id', $request->input('search_use_case_preset_id'))
							        ->where('data_stream_preset_field_id', $request->input('data_stream_preset_field_id'))->exists()) {
			return $this->response->errorBadRequest(Lang::get('errors.search_use_case_preset_field_exists'));
		}

		$searchUseCasePresetField = SearchUseCasePresetField::create($request->all(), $request->getRealMethod());

		if ($searchUseCasePresetField) {
			// Register model transformer for created/accepted responses
			// @link https://github.com/dingo/api/issues/1218
			app('Dingo\Api\Transformer\Factory')->register(
				SearchUseCasePresetField::class,
				SearchUseCasePresetFieldTransformer::class
			);

			return $this->response->created(
				app('Dingo\Api\Routing\UrlGenerator')
					->version('v1')
					->route('searchUseCaseField.show', [$searchUseCasePresetField->search_use_case_preset_id,
														$searchUseCasePresetField->data_stream_preset_field_id]), $searchUseCasePresetField
			);
		}

		return $this->response->errorBadRequest();
	}

	/**
	 * Update a specified search use case preset field
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId update
	 * @OpenApiOperationTag Resource:SearchUseCasePresetField
	 * @OpenApiResponseSchemaRef #/components/schemas/SearchUseCasePresetFieldResponse
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 * @OpenApiResponseDescription The updated SearchUseCasePresetField
	 *
	 * @param UpdateSearchUseCasePresetFieldRequest $request
	 * @param string $searchUseCasePresetId Search use case preset UUID
	 * @param string $dataStreamPresetFieldId Data stream preset field UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function update(UpdateSearchUseCasePresetFieldRequest $request, $searchUseCasePresetId, $dataStreamPresetFieldId)
	{
		$searchUseCasePresetField = SearchUseCasePresetField::where('search_use_case_preset_id', $searchUseCasePresetId)
															->where('data_stream_preset_field_id', $dataStreamPresetFieldId)->get();

		if (!$searchUseCasePresetField)
			return $this->response->errorNotFound();

		// Check if a relationship between the specified search use case preset and data stream preset field already exists. (ignoring the current if not changed).
		if (($searchUseCasePresetId != $request->input('search_use_case_preset_id')) || ($dataStreamPresetFieldId != $request->input('data_stream_preset_field_id'))) {
			if (SearchUseCasePresetField::where('search_use_case_preset_id', $request->input('search_use_case_preset_id'))
								        ->where('data_stream_preset_field_id', $request->input('data_stream_preset_field_id'))->exists()) {
				return $this->response->errorBadRequest(Lang::get('errors.search_use_case_preset_field_exists'));
			}
		}

		$search_use_case_preset_id      = ($request->has('search_use_case_id') ? $request->input('search_use_case_id') : $searchUseCasePresetId);
		$data_stream_preset_field_id    = ($request->has('data_stream_field_id') ? $request->input('data_stream_field_id') : $dataStreamPresetFieldId);
		$name                           = ($request->has('name') ? $request->input('name') : $searchUseCasePresetField->name);
		$searchable                     = ($request->has('searchable') ? $request->input('searchable') : $searchUseCasePresetField->name);
		$to_retrieve                    = ($request->has('to_retrieve') ? $request->input('to_retrieve') : $searchUseCasePresetField->name);

		SearchUseCasePresetField::where('search_use_case_preset_id', $searchUseCasePresetId)->where('data_stream_preset_field_id', $dataStreamPresetFieldId)->update([
			'search_use_case_preset_id'     => $search_use_case_preset_id,
			'data_stream_preset_field_id'   => $data_stream_preset_field_id,
			'name'                          => $name,
			'searchable'                    => $searchable,
			'to_retrieve'                   => $to_retrieve,
		]);

		$searchUseCasePresetField = SearchUseCasePresetField::where('search_use_case_preset_id', $search_use_case_preset_id)
															->where('data_stream_preset_field_id', $data_stream_preset_field_id)->first();

		return $this->response->item($searchUseCasePresetField, new SearchUseCasePresetFieldTransformer);
	}

	/**
	 * Delete specified search use case preset field
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId delete
	 * @OpenApiOperationTag Resource:SearchUseCasePresetField
	 * @OpenApiResponseDescription Empty response
	 * @OpenApiDefaultResponseSchemaRef #/components/schemas/ErrorResponse
	 *
	 * @param string $searchUseCasePresetId Search use case preset UUID
	 * @param string $dataStreamPresetFieldId Data stream preset field UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function destroy($searchUseCasePresetId, $dataStreamPresetFieldId)
	{
		if (!SearchUseCasePresetField::where('search_use_case_preset_id', $searchUseCasePresetId)
					                 ->where('data_stream_preset_field_id', $dataStreamPresetFieldId)->exists()) {
			return $this->response->errorNotFound();
		}

		SearchUseCasePresetField::where('search_use_case_preset_id', $searchUseCasePresetId)
						        ->where('data_stream_preset_field_id', $dataStreamPresetFieldId)->delete();

		return $this->response->noContent();
	}
}
