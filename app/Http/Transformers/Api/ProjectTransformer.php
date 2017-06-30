<?php

namespace App\Http\Transformers\Api;

use App\Models\Project;

class ProjectTransformer extends ApiTransformer
{
	/**
	 * Resources that can be included if requested.
	 *
	 * @var array
	 */
	protected $availableIncludes = [
		'searchEngine',
		'dataStream',
	];

	/**
	 * Turn this item object into a generic array
	 *
	 * @param Project $project
	 * @return array
	 */
	public function transform(Project $project)
	{
		return $this->filterWithModelConfiguration(
			Project::class,
			[
				'id'                => $project->id,
				'search_engine_id'  => $project->search_engine_id,
				'data_stream_id'    => $project->data_stream_id,
				'name'              => $project->name,
				'created_at'        => $project->created_at->toDateTimeString(),
				'updated_at'        => $project->updated_at->toDateTimeString()
			]
		);
	}

	/**
	 * Include SearchEngine
	 *
	 * @param Project $project
	 * @return League\Fractal\ItemResource
	 */
	public function includeSearchEngine(Project $project)
	{
		$searchEngine = $project->searchEngine;

		return $this->item($searchEngine, new SearchEngineTransformer);
	}

	/**
	 * Include DataStream
	 *
	 * @param Project $project
	 * @return League\Fractal\ItemResource
	 */
	public function includeDataStream(Project $project)
	{
		// Nullable foreign key
		if (is_null($project->data_stream_id)) {
			return $this->null();
		}

		$dataStream = $project->dataStream;

		return $this->item($dataStream, new DataStreamTransformer);
	}
}