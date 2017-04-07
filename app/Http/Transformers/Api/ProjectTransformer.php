<?php

namespace App\Http\Transformers\Api;

use App\Models\Project;

class ProjectTransformer extends ApiTransformer
{
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
				'id' => $project->id,
				'search_engine_id' => $project->search_engine_id,
				'data_stream_id' => $project->data_stream_id,
				'name' => $project->name,
				'created_at' => $project->created_at->toDateTimeString(),
				'updated_at' => $project->updated_at->toDateTimeString()
			]
		);
	}
}