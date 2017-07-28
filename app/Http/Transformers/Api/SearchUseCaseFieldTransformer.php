<?php

namespace App\Http\Transformers\Api;

use App\Models\SearchUseCaseField;

class SearchUseCaseFieldTransformer extends ApiTransformer
{
	/**
	 * Resources that can be included if requested.
	 *
	 * @var array
	 */
	protected $availableIncludes = [
		'searchUseCase',
		'dataStreamField'
	];

	/**
	 * Turn this item object into a generic array
	 *
	 * @param SearchUseCaseField $searchUseCaseField
	 * @return array
	 */
	public function transform(SearchUseCaseField $searchUseCaseField)
	{
		return $this->filterWithModelConfiguration(
			SearchUseCaseField::class,
			[
				'search_use_case_id'    => $searchUseCaseField->search_use_case_id,
				'data_stream_field_id'  => $searchUseCaseField->data_stream_field_id,
				'name'                  => $searchUseCaseField->name,
				'searchable'            => $searchUseCaseField->searchable,
				'to_retrieve'           => $searchUseCaseField->to_retrieve,
				'created_at'            => $searchUseCaseField->created_at->toDateTimeString(),
				'updated_at'            => $searchUseCaseField->updated_at->toDateTimeString()
			]
		);
	}

	/**
	 * Include SearchUseCase
	 *
	 * @param SearchUseCaseField $searchUseCaseField
	 * @return League\Fractal\ItemResource
	 */
	public function includeSearchUseCase(SearchUseCaseField $searchUseCaseField)
	{
		$searchUseCase = $searchUseCaseField->searchUseCase;

		return $this->item($searchUseCase, new SearchUseCaseTransformer);
	}

	/**
	 * Include dataStreamField
	 *
	 * @param SearchUseCaseField $searchUseCaseField
	 * @return League\Fractal\ItemResource
	 */
	public function includeDataStreamField(SearchUseCaseField $searchUseCaseField)
	{
		$dataStreamField = $searchUseCaseField->dataStreamField;

		return $this->item($dataStreamField, new DataStreamFieldTransformer);
	}
}