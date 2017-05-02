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
	 * Apply request query string for ordering, filtering, searching, etc. using params configuration mixed array.
	 *
	 * @return $this
	 */
	public function applyRequestQueryString()
	{
		// Configuration

		$modelClass = get_class($this->model);

		$modelsConfig = config('models');

		if (!isset($modelsConfig[$modelClass])) {
			return $this;
		}

		$config = $modelsConfig[$modelClass];

		if (!isset($config['requestQueryStringParameters'])) {
			return $this;
		}

		$params = $config['requestQueryStringParameters'];

		// Basic searching

		$request_search = Request::input('search');

		if (!is_null($request_search)) {
			if (!isset($params['defaultSearchColumns'])) {
				throw new ValidationHttpException(['No search parameter is allowed on this route.']);
			}

			// Replace '*' char by '%' in here clause
			$request_search = str_replace('*', '%', $request_search);

			// Classic search if no special chars are defined
			if (!strstr($request_search, '%')) {
				$request_search = '%' . $request_search . '%';
			}

			$searchColumns = explode(',', $params['defaultSearchColumns']);
			foreach ($searchColumns as $searchColumn) {
				$this->orWhere($searchColumn, 'like', $request_search);
			}
		}

		// Order by

		$request_order_by = Request::input('order_by');

		if (!is_null($request_order_by)) {

			if (!isset($params['authorizedOrderByColumns'])) {
				throw new ValidationHttpException(['No order_by parameter is allowed on this route.']);
			}

			$conditions = explode('|', $request_order_by);
			foreach ($conditions as $condition) {
				$conditionArray = explode(',', $condition);
				if (count($conditionArray) == 1) {
					$column = $condition;
					$direction = 'asc';
				} else {
					list($column, $direction) = $conditionArray;
				}

				$validator = Validator::make(['order_by_column' => $column, 'order_by_direction' => $direction], [
					'order_by_column' => 'in:' . $params['authorizedOrderByColumns'],
					'order_by_direction' => 'in:asc,desc'
				]);

				if ($validator->fails()) {
					throw new ValidationHttpException($validator->errors());
				}

				$this->orderBy($column, $direction);
			}
		}

		return $this;
	}
	
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