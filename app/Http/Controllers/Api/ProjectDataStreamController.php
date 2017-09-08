<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreProjectDataStreamRequest;
use App\Http\Requests\UpdateProjectDataStreamRequest;
use App\Http\Transformers\Api\DataStreamTransformer;
use App\Models\DataStream;
use App\Models\Project;

/**
 * @resource DataStream
 * @OpenApiOperationTag Resource:Project
 *
 * @package App\Http\Controllers\Api
 */
class ProjectDataStreamController extends ApiController
{
	/**
	 * Show project data stream
	 *
	 * @OpenApiOperationId getDataStream
	 * @OpenApiResponseSchemaRef #/components/schemas/DataStreamResponse
	 * @OpenApiResponseDescription A DataStream
	 *
	 * @param string $projectId Project UUID
	 * @return \Dingo\Api\Http\Response
	 */
	public function show($projectId)
	{
		$project = Project::authorized(['Owner', 'Administrator'])->find($projectId);

		if (!$project)
			return $this->response->errorNotFound();

		$dataStream = $project->dataStream()->first();

		if (!$dataStream)
			return $this->response->errorNotFound();

		return $this->response->item($dataStream, new DataStreamTransformer);
	}

	/**
	 * Create and store the project data stream
	 *
	 * Only one data stream per project is allowed.
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId createDataStream
	 * @OpenApiResponseSchemaRef #/components/schemas/DataStreamResponse
	 * @OpenApiResponseDescription A DataStreamResponse
	 *
	 * @param StoreProjectDataStreamRequest $request
	 * @param string $projectId Project UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function store(StoreProjectDataStreamRequest $request, $projectId)
	{
		$project = Project::authorized(['Owner', 'Administrator'])->find($projectId);

		if (!$project)
			return $this->response->errorNotFound();

		if ($project->dataStream()->exists())
			return $this->response->errorForbidden('This project has already a data stream.');

		$dataStream = DataStream::create($request->all(), $request->getRealMethod());

		if ($dataStream) {
			// Associate data stream with the parent project
			$project->dataStream()->associate($dataStream);
			$project->save();

			// Register model transformer for created/accepted responses
			// @link https://github.com/dingo/api/issues/1218
			app('Dingo\Api\Transformer\Factory')->register(
				DataStream::class,
				DataStreamTransformer::class
			);

			return $this->response->created(
				app('Dingo\Api\Routing\UrlGenerator')
					->version('v1')
					->route('projectDataStream.show', $project->id),
				$dataStream);
		}

		return $this->response->errorBadRequest();
	}

	/**
	 * Update the project data stream
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId updateDataStream
	 * @OpenApiResponseSchemaRef #/components/schemas/DataStreamResponse
	 * @OpenApiResponseDescription A DataStreamResponse
	 *
	 * @param UpdateProjectDataStreamRequest $request
	 * @param string $projectId Project UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function update(UpdateProjectDataStreamRequest $request, $projectId)
	{
		$project = Project::authorized(['Owner', 'Administrator'])->find($projectId);

		if (!$project)
			return $this->response->errorNotFound();

		$dataStream = $project->dataStream()->first();

		if (!$dataStream)
			return $this->response->errorNotFound();

		$dataStream->fill($request->all(), $request->getRealMethod());
		$dataStream->save();

		return $this->response->item($dataStream, new DataStreamTransformer);
	}

	/**
	 * Delete the project data stream
	 *
	 * @ApiDocsNoCall
	 *
	 * @OpenApiOperationId deleteDataStream
	 * @OpenApiResponseDescription Empty response
	 *
	 * @param string $projectId Project UUID
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function destroy($projectId)
	{
		$project = Project::authorized(['Owner'])->find($projectId);

		if (!$project)
			return $this->response->errorNotFound();

		$dataStream = $project->dataStream()->first();

		if (!$dataStream)
			return $this->response->errorNotFound();

		// Dissociate data stream with the parent project
		$project->dataStream()->dissociate();
		$project->save();

		$dataStream->delete();

		return $this->response->noContent();
	}
}
