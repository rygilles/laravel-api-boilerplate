<?php

namespace App\Libs;

use Dingo\Api\Exception\ValidationHttpException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Custom Eloquent query builder for Api models
 */
class ApiEloquentBuilder extends Builder
{
	/**
	 * Paginate the given query.
	 *
	 * @param  int $perPage
	 * @param  array $columns
	 * @param  string $pageName
	 * @param  int|null $page
	 * @param  string $limitName
	 * @param  int|null $limit
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 * @throws ValidationHttpException
	 */
	public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null, $limitName = 'limit', $limit = null)
	{
		// Grab the request page number and validate

		if (is_null($page))
		{
			$request_page = Request::input('page');

			if (!is_null($request_page))
			{
				$validator = Validator::make(['page' => $request_page], [
					'page' => 'int|min:1'
				]);

				if ($validator->fails()) {
					throw new ValidationHttpException($validator->errors());
				}

				$page = $request_page;
			}
		}

		if (is_null($page))
			$page = 1;

		// Grab the request limit (perPage) number and validate

		if (is_null($perPage))
		{
			$request_perPage = Request::input('limit');

			if (!is_null($request_perPage))
			{
				$perPageMin = $this->model->getPerPageMin();
				$perPageMax = $this->model->getPerPageMax();

				$validator = Validator::make(['limit' => $request_perPage], [
					'limit' => 'int|min:' . $perPageMin . '|max:' . $perPageMax,
				]);

				if ($validator->fails()) {
					throw new ValidationHttpException($validator->errors());
				}

				$perPage = $request_perPage;
			}
		}

		if (is_null($perPage))
			$perPage = $this->model->getPerPage();

		$query = $this->toBase();

		$total = $query->getCountForPagination();

		$results = $total ? $this->forPage($page, $perPage)->get($columns) : new Collection;

		$paginator = new LengthAwarePaginator($results, $total, $perPage, $page, [
			'path' => Paginator::resolveCurrentPath(),
			'pageName' => $pageName,
		]);

		$paginator->appends(Request::except('page, limit'));

		return $paginator;
	}

	/**
	 * Paginate the given query into a simple paginator.
	 *
	 * @param  int $perPage
	 * @param  array $columns
	 * @param  string $pageName
	 * @param  int|null $page
	 * @param  string $limitName
	 * @param  int|null $limit
	 * @return \Illuminate\Contracts\Pagination\Paginator
	 * @throws ValidationHttpException
	 */
	public function simplePaginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null, $limitName = 'limit', $limit = null)
	{
		// Grab the request page number and validate

		if (is_null($page))
		{
			$request_page = Request::input('page');

			if (!is_null($request_page))
			{
				$validator = Validator::make(['page' => $request_page], [
					'page' => 'int|min:1'
				]);

				if ($validator->fails()) {
					throw new ValidationHttpException($validator->errors());
				}

				$page = $request_page;
			}
		}

		if (is_null($page))
			$page = 1;

		// Grab the request limit (perPage) number and validate

		if (is_null($perPage))
		{
			$request_perPage = Request::input('limit');

			if (!is_null($request_perPage))
			{
				$perPageMin = $this->model->getPerPageMin();
				$perPageMax = $this->model->getPerPageMax();

				$validator = Validator::make(['limit' => $request_perPage], [
					'limit' => 'int|min:' . $perPageMin . '|max:' . $perPageMax,
				]);

				if ($validator->fails()) {
					throw new ValidationHttpException($validator->errors());
				}

				$perPage = $request_perPage;
			}
		}

		if (is_null($perPage))
			$perPage = $this->model->getPerPage();

		$this->skip(($page - 1) * $perPage)->take($perPage + 1);

		$paginator = new Paginator($this->get($columns), $perPage, $page, [
			'path' => Paginator::resolveCurrentPath(),
			'pageName' => $pageName,
		]);

		$paginator->appends(Request::except('page, limit'));

		return $paginator;
	}
}