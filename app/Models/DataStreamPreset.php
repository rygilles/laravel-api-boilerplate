<?php

namespace App\Models;

use Alsofronie\Uuid\UuidModelTrait;

/**
 * Class DataStreamPreset
 * @package App\Models
 */
class DataStreamPreset extends ApiModel
{
	use UuidModelTrait;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'data_stream_preset';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
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
	 * Model fillable fields for new items
	 * @var array
	 */
	protected static $storeFillable = [
		'data_stream_decoder_id',
		'name',
	];

	/**
	 * Model fillable fields for item patch
	 * @var array
	 */
	protected static $patchFillable = [
		'data_stream_decoder_id',
		'name'
	];

	/**
	 * Model fillable fields for item replacement
	 * @var array
	 */
	protected static $putFillable = [
		'data_stream_decoder_id',
		'name'
	];

	/**
	 * Model validation rules for new items
	 * @var string[]
	 */
	protected static $storeRules = [
		'data_stream_decoder_id'    => 'required|uuid|exists:data_stream_decoder,id',
		'name'                      => 'required|string|min:5|max:200',
	];

	/**
	 * Model validation rules for item patch
	 * @var string[]
	 */
	protected static $patchRules = [
		'data_stream_decoder_id'    => 'uuid|exists:data_stream_decoder,id',
		'name'                      => 'min:5|string|max:200',
	];

	/**
	 * Model validation rules for item replacement
	 * @var string[]
	 */
	protected static $putRules = [
		'data_stream_decoder_id'    => 'required|uuid|exists:data_stream_decoder,id',
		'name'                      => 'required|string|min:5|max:200',
	];

	/**
	 * Get the data stream decoder of this data stream
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function dataStreamDecoder()
	{
		return $this->belongsTo(DataStreamDecoder::class);
	}

	/**
	 * Get the data stream preset fields of this data stream preset
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function dataStreamPresetFields()
	{
		return $this->hasMany(DataStreamPresetField::class);
	}

	/**
	 * Get the search use case presets of this data stream preset
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function searchUseCasePresets()
	{
		return $this->hasMany(SearchUseCasePreset::class);
	}

	/**
	 * Get the widget presets of this data stream preset
	 *
	 * (Through the related search use case presets)
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function widgetPresets()
	{
		return $this->hasManyThrough(WidgetPreset::class, SearchUseCasePreset::class);
	}
}
