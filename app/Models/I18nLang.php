<?php

namespace App\Models;

/**
 * Class I18nLang
 * @package App\Models
 */
class I18nLang extends ApiModel
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'i18n_lang';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'description'
	];

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

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
		'id'            => 'required|string|max:30|unique:i18n_lang,id',
		'description'   => 'required|string'
	];

	/**
	 * Model validation rules for item patch
	 * @var array
	 */
	protected static $patchRules = [
		'description'   => 'string'
	];

	/**
	 * Model validation rules for item replacement
	 * @var array
	 */
	protected static $putRules = [
		'description'   => 'required|string'
	];

	/**
	 * Model default validation rules
	 * @return string[]
	 */
	public function rules()
	{
		return self::getStoreRules();
	}

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
