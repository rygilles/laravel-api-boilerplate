<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\DataStreamTransformer;
use App\Models\Project;

/**
 * @resource DataStream
 *
 * @package App\Http\Controllers\Api
 */
class ProjectDataStreamController extends ApiController
{
	/**
	 * Show project data stream
	 *
	 * @param string $projectId Project UUID
	 * @return \Dingo\Api\Http\Response
	 */
	public function show($projectId)
	{
		$dataStream = Project::authorized(['Owner', 'Administrator'])->find($projectId)->dataStream()->first();

		if (!$dataStream)
			return $this->response->errorNotFound();

		return $this->response->item($dataStream, new DataStreamTransformer);
	}
}
