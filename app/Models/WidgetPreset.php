<?php

namespace App\Models;

use Alsofronie\Uuid\UuidModelTrait;

/**
 * Class WidgetPreset
 * @package App\Models
 */
class WidgetPreset extends ApiModel
{
	use UuidModelTrait;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'widget_preset';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'search_use_case_preset_id',
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
	 * Pagination limit inclusive max value
	 * @var int
	 */
	protected $perPageMax = 50;

	/**
	 * Model fillable fields for new items
	 * @var array
	 */
	protected static $storeFillable = [
		'search_use_case_preset_id',
		'name',
	];

	/**
	 * Model fillable fields for item patch
	 * @var array
	 */
	protected static $patchFillable = [
		'search_use_case_preset_id',
		'name',
	];

	/**
	 * Model fillable fields for item replacement
	 * @var array
	 */
	protected static $putFillable = [
		'search_use_case_preset_id',
		'name',
	];

	/**
	 * Model validation rules for new items
	 * @var string[]
	 */
	protected static $storeRules = [
		'search_use_case_preset_id'     => 'required|uuid|exists:search_use_case_preset,id',
		'name'                          => 'required|string|min:5|max:200'
	];

	/**
	 * Model validation rules for item patch
	 * @var string[]
	 */
	protected static $patchRules = [
		'search_use_case_preset_id'     => 'uuid|exists:search_use_case_preset,id',
		'name'                          => 'string|min:5|max:200'
	];

	/**
	 * Model validation rules for item replacement
	 * @var string[]
	 */
	protected static $putRules = [
		'search_use_case_preset_id'     => 'required|uuid|exists:search_use_case_preset,id',
		'name'                          => 'required|string|min:5|max:200'
	];

	/**
	 * Get the search use case preset of this widget preset
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function searchUseCasePreset()
	{
		return $this->belongsTo(searchUseCasePreset::class);
	}

	// @todo widgetPresetIntegrations
}
