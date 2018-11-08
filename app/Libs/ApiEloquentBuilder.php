<?php

namespace App\Libs;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Dingo\Api\Exception\ValidationHttpException;

/**
 * Custom Eloquent query builder for Api models.
 */
class ApiEloquentBuilder extends Builder
{
    /**
     * Save a new model and return the instance.
     *
     * @param  array  $attributes
     * @param  string|null $requestMethod
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $attributes = [], $requestMethod = null)
    {
        $instance = $this->model->newInstance($attributes, false, $requestMethod)->setConnection(
            $this->query->getConnection()->getName()
        );

        $instance->save();

        return $instance;
    }

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

        if (! isset($modelsConfig[$modelClass])) {
            return $this;
        }

        $config = $modelsConfig[$modelClass];

        if (! isset($config['requestQueryStringParameters'])) {
            return $this;
        }

        $params = $config['requestQueryStringParameters'];

        // Basic searching

        if (Request::has('search')) {
            if (! isset($params['authorizeSearch']) || (isset($params['authorizeSearch']) && ($params['authorizeSearch'] == false))) {
                throw new ValidationHttpException(['No search parameter is allowed on this route.']);
            }

            $request_search = Request::input('search');

            // Replace '*' char by '%' in here clause
            $request_search = str_replace('*', '%', $request_search);

            // Classic search if no special chars are defined
            if (! strstr($request_search, '%')) {
                $request_search = '%'.$request_search.'%';
            }

            $searchColumns = explode(',', $params['defaultSearchColumns']);

            $this->where(function ($query) use ($searchColumns, $request_search) {
                foreach ($searchColumns as $searchColumn) {
                    $query->orWhere($searchColumn, 'like', $request_search);
                }
            });
        }

        // Creation date bounding

        if (Request::has('created_before') || Request::has('created_after')) {
            if (! isset($params['authorizeCreationDateBounding']) || (isset($params['authorizeCreationDateBounding']) && ($params['authorizeCreationDateBounding'] == false))) {
                throw new ValidationHttpException(['No creation date bounding parameter is allowed on this route.']);
            }

            if (Request::has('created_before')) {
                $request_created_before = Request::input('created_before');

                $validator = Validator::make(['created_before' => $request_created_before], [
                    'created_before' => 'date',
                ]);

                if ($validator->fails()) {
                    throw new ValidationHttpException($validator->errors());
                }

                $this->where('created_at', '<', $request_created_before);
            }

            if (Request::has('created_after')) {
                $request_created_after = Request::input('created_after');

                $validator = Validator::make(['created_after' => $request_created_after], [
                    'created_after' => 'date',
                ]);

                if ($validator->fails()) {
                    throw new ValidationHttpException($validator->errors());
                }

                $this->where('created_at', '>', $request_created_after);
            }
        }

        // Update date bounding

        if (Request::has('updated_before') || Request::has('updated_after')) {
            if (! isset($params['authorizeUpdateDateBounding']) || (isset($params['authorizeUpdateDateBounding']) && ($params['authorizeUpdateDateBounding'] == false))) {
                throw new ValidationHttpException(['No update date bounding parameter is allowed on this route.']);
            }

            if (Request::has('updated_before')) {
                $request_updated_before = Request::input('updated_before');

                $validator = Validator::make(['updated_before' => $request_updated_before], [
                    'updated_before' => 'date',
                ]);

                if ($validator->fails()) {
                    throw new ValidationHttpException($validator->errors());
                }

                $this->where('updated_at', '<', $request_updated_before);
            }

            if (Request::has('updated_after')) {
                $request_updated_after = Request::input('updated_after');

                $validator = Validator::make(['updated_after' => $request_updated_after], [
                    'updated_after' => 'date',
                ]);

                if ($validator->fails()) {
                    throw new ValidationHttpException($validator->errors());
                }

                $this->where('updated_at', '>', $request_updated_after);
            }
        }

        // Order by

        if (Request::has('order_by')) {
            if (! isset($params['authorizedOrderByColumns'])) {
                throw new ValidationHttpException(['No order_by parameter is allowed on this route.']);
            }

            $request_order_by = Request::input('order_by');

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
                    'order_by_column' => 'in:'.$params['authorizedOrderByColumns'],
                    'order_by_direction' => 'in:asc,desc',
                ]);

                if ($validator->fails()) {
                    throw new ValidationHttpException($validator->errors());
                }

                $this->orderBy($column, $direction);
            }
        }

        // Include

        if (Request::has('include')) {
            if (! isset($params['authorizedIncludes'])) {
                throw new ValidationHttpException(['No include parameter is allowed on this route.']);
            }

            $request_include = Request::input('include');

            $includes = explode(',', $request_include);
            foreach ($includes as $include) {
                $validator = Validator::make(['include' => $include], [
                    'include' => 'in:'.$params['authorizedIncludes'],
                ]);

                if ($validator->fails()) {
                    throw new ValidationHttpException($validator->errors());
                }

                $this->with($include);
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

        if (is_null($page)) {
            $request_page = Request::input('page');

            if (! is_null($request_page)) {
                $validator = Validator::make(['page' => $request_page], [
                    'page' => 'int|min:1',
                ]);

                if ($validator->fails()) {
                    throw new ValidationHttpException($validator->errors());
                }

                $page = $request_page;
            }
        }

        if (is_null($page)) {
            $page = 1;
        }

        // Grab the request limit (perPage) number and validate

        if (is_null($perPage)) {
            $request_perPage = Request::input('limit');

            if (! is_null($request_perPage)) {
                $perPageMin = $this->model->getPerPageMin();
                $perPageMax = $this->model->getPerPageMax();

                $validator = Validator::make(['limit' => $request_perPage], [
                    'limit' => 'int|min:'.$perPageMin.'|max:'.$perPageMax,
                ]);

                if ($validator->fails()) {
                    throw new ValidationHttpException($validator->errors());
                }

                $perPage = $request_perPage;
            }
        }

        if (is_null($perPage)) {
            $perPage = $this->model->getPerPage();
        }

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

        if (is_null($page)) {
            $request_page = Request::input('page');

            if (! is_null($request_page)) {
                $validator = Validator::make(['page' => $request_page], [
                    'page' => 'int|min:1',
                ]);

                if ($validator->fails()) {
                    throw new ValidationHttpException($validator->errors());
                }

                $page = $request_page;
            }
        }

        if (is_null($page)) {
            $page = 1;
        }

        // Grab the request limit (perPage) number and validate

        if (is_null($perPage)) {
            $request_perPage = Request::input('limit');

            if (! is_null($request_perPage)) {
                $perPageMin = $this->model->getPerPageMin();
                $perPageMax = $this->model->getPerPageMax();

                $validator = Validator::make(['limit' => $request_perPage], [
                    'limit' => 'int|min:'.$perPageMin.'|max:'.$perPageMax,
                ]);

                if ($validator->fails()) {
                    throw new ValidationHttpException($validator->errors());
                }

                $perPage = $request_perPage;
            }
        }

        if (is_null($perPage)) {
            $perPage = $this->model->getPerPage();
        }

        $this->skip(($page - 1) * $perPage)->take($perPage + 1);

        $paginator = new Paginator($this->get($columns), $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => $pageName,
        ]);

        $paginator->appends(Request::except('page, limit'));

        return $paginator;
    }
}
