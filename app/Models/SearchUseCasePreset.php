<?php

namespace App\Models;

use Alsofronie\Uuid\UuidModelTrait;

/**
 * Class SearchUseCasePreset
 * @package App\Models
 */
class SearchUseCasePreset extends ApiModel
{
	use UuidModelTrait;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'search_use_case_preset';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'data_stream_preset_id',
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
		'data_stream_preset_id',
		'name',
	];

	/**
	 * Model fillable fields for item patch
	 * @var array
	 */
	protected static $patchFillable = [
		'data_stream_preset_id',
		'name',
	];

	/**
	 * Model fillable fields for item replacement
	 * @var array
	 */
	protected static $putFillable = [
		'data_stream_preset_id',
		'name',
	];

	/**
	 * Model validation rules for new items
	 * @var string[]
	 */
	protected static $storeRules = [
		'data_stream_preset_id'     => 'required|uuid|exists:data_stream_preset,id',
		'name'                      => 'required|string|min:5|max:200'
	];

	/**
	 * Model validation rules for item patch
	 * @var string[]
	 */
	protected static $patchRules = [
		'data_stream_preset_id'     => 'uuid|exists:data_stream_preset,id',
		'name'                      => 'string|min:5|max:200'
	];

	/**
	 * Model validation rules for item replacement
	 * @var string[]
	 */
	protected static $putRules = [
		'data_stream_preset_id'     => 'required|uuid|exists:data_stream_preset,id',
		'name'                      => 'required|string|min:5|max:200'
	];

	/**
	 * Get the data stream preset of this search use case preset
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function dataStreamPreset()
	{
		return $this->belongsTo(DataStreamPreset::class);
	}

	/**
	 * Get the search use case preset fields of this search use case preset
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function searchUseCasePresetFields()
	{
		return $this->hasMany(SearchUseCasePresetField::class);
	}

	/**
	 * Get the widget presets of this search use case preset
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function widgetPresets()
	{
		return $this->hasMany(WidgetPreset::class);
	}
}
