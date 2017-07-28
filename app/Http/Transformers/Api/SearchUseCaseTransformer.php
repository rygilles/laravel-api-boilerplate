<?php

namespace App\Http\Transformers\Api;

use App\Models\SearchUseCase;

class SearchUseCaseTransformer extends ApiTransformer
{
	/**
	 * Resources that can be included if requested.
	 *
	 * @var array
	 */
	protected $availableIncludes = [
		'project',
	];

	/**
	 * Turn this item object into a generic array
	 *
	 * @param SearchUseCase $searchUseCase
	 * @return array
	 */
	public function transform(SearchUseCase $searchUseCase)
	{
		return $this->filterWithModelConfiguration(
			SearchUseCase::class,
			[
				'id'                                => $searchUseCase->id,
				'project_id'                        => $searchUseCase->project_id,
				'name'                              => $searchUseCase->name,
				'created_at'                        => $searchUseCase->created_at->toDateTimeString(),
				'updated_at'                        => $searchUseCase->updated_at->toDateTimeString(),
				'search_use_case_fields_count'      => (int) $searchUseCase->search_use_case_fields_count,
			]
		);
	}

	/**
	 * Include project
	 *
	 * @param SearchUseCase $searchUseCase
	 * @return League\Fractal\ItemResource
	 */
	public function includeProject(SearchUseCase $searchUseCase)
	{
		$project = $searchUseCase->project;

		return $this->item($project, new ProjectTransformer);
	}
}