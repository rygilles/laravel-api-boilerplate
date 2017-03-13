<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Libs\ApiEloquentBuilder;

/**
 * Api Model class with custom Eloquent query builder for api resources
 * @package App\Models
 */
class ApiModel extends Model
{
	/**
	 * Pagination limit inclusive min value
	 * @var int
	 */
	protected $perPageMin = 1;

	/**
	 * Pagination limit inclusive max value
	 * @var int
	 */
	protected $perPageMax = 20;

	/**
	 * {@inheritDoc}
	 */
	public function newEloquentBuilder($query)
	{
		return new ApiEloquentBuilder($query);
	}

	/**
	 * Get the min limit number of models to return per page.
	 *
	 * @return int
	 */
	public function getPerPageMin()
	{
		return $this->perPageMin;
	}

	/**
	 * Set the min limit number of models to return per page.
	 *
	 * @param  int  $perPageMin
	 * @return $this
	 */
	public function setPerPageMin($perPageMin)
	{
		$this->perPageMin = $perPageMin;

		return $this;
	}

	/**
	 * Get the max limit number of models to return per page.
	 *
	 * @return int
	 */
	public function getPerPageMax()
	{
		return $this->perPageMax;
	}

	/**
	 * Set the max limit number of models to return per page.
	 *
	 * @param  int  $perPageMax
	 * @return $this
	 */
	public function setPerPageMax($perPageMax)
	{
		$this->perPageMax = $perPageMax;

		return $this;
	}
}

