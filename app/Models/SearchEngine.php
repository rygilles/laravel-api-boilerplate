<?php

namespace App\Models;

use Alsofronie\Uuid\UuidModelTrait;

/**
 * Class Project
 * @package App\Models
 */
class SearchEngine extends ApiModel
{
	use UuidModelTrait;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'search_engine';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name'
	];

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = true;

	/**
	 * Indicates if the IDs are auto-incrementing.
	 *
	 * @var bool
	 */
	public $incrementing = false;

	/**
	 * Default pagination limit
	 * @var int
	 */
	protected $perPage = 20;

	/**
	 * Pagination limit inclusive min value
	 * @var int
	 */
	protected $perPageMin = 1;

	/**
	 * Pagination limit inclusive max value
	 * @var int
	 */
	protected $perPageMax = 50;

	/**
	 * Model validation rules for new items
	 * @var array
	 */
	protected static $storeRules = [
		'name'              => 'required|string|max:100'
	];

	/**
	 * Model validation rules for item patch
	 * @var array
	 */
	protected static $patchRules = [
		'name'              => 'required|string|max:100'
	];

	/**
	 * Model validation rules for item replacement
	 * @var array
	 */
	protected static $putRules = [
		'name'              => 'required|string|max:100'
	];

	/**
	 * Get model validation rules for new items
	 * @return array
	 */
	public static function getStoreRules()
	{
		return self::$storeRules;
	}

	/**
	 * Get model validation rules for item patch
	 * @return array
	 */
	public static function getPatchRules()
	{
		return self::$patchRules;
	}

	/**
	 * Get model validation rules for item replacement
	 * @return array
	 */
	public static function getPutRules()
	{
		return self::$putRules;
	}
}
