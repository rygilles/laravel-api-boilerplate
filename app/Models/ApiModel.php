<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Libs\ApiEloquentBuilder;
use Illuminate\Support\Facades\Auth;

/**
 * Api Model class with custom Eloquent query builder for api resources
 * @package App\Models
 */
class ApiModel extends Model
{
	/**
	 * Default pagination limit
	 * @var int
	 */
	protected $perPage = 10;

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
	 * Model validation rules for new items
	 * @var array
	 */
	protected static $storeRules = [];

	/**
	 * Model validation rules for item patch
	 * @var array
	 */
	protected static $patchRules = [];

	/**
	 * Model validation rules for item replacement
	 * @var array
	 */
	protected static $putRules = [];

	/**
	 * Create a new Eloquent model instance.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
	{
		// Filter user only if already authenticated

		// @todo ERR_EMPTY_RESPONSE on frontend ! :(
		if (!Auth::user()) {
			parent::__construct($attributes);
			return;
		}

		$modelsConfig = config('models');

		if (!isset($modelsConfig[static::class])) {
			parent::__construct($attributes);
			return;
		}

		$config = $modelsConfig[static::class];

		if (!isset($config['attributes'])) {
			parent::__construct($attributes);
			return;
		}

		foreach ($config['attributes'] as $attribute => $attributeConfig) {
			if (isset($attributeConfig['apiCannotFillOnUserGroups'])) {
				if (!in_array(Auth::user()->user_group_id, $attributeConfig['apiCannotFillOnUserGroups'])) {
					$this->setHidden([$attribute]);
					$this->guard([$attribute]);
					if (isset($attributes[$attribute])) {
						unset($attributes[$attribute]);
					}
				}
			}

			if (isset($attributeConfig['defaultValue'])) {
				$this->attributes[$attribute] = $attributeConfig['defaultValue'];
			}
		}

		parent::__construct($attributes);
	}

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

	/**
	 * Model default validation rules
	 * @return string[]
	 */
	public function rules()
	{
		return static::getStoreRules();
	}

	/**
	 * Get model validation rules for new items
	 * @return array
	 */
	public static function getStoreRules()
	{
		return static::$storeRules;
	}

	/**
	 * Get model validation rules for item patch
	 * @return array
	 */
	public static function getPatchRules()
	{
		return static::$patchRules;
	}

	/**
	 * Get model validation rules for item replacement
	 * @return array
	 */
	public static function getPutRules()
	{
		return static::$putRules;
	}
}

