<?php

namespace App\Models;

use Alsofronie\Uuid\UuidModelTrait;

/**
 * Class DataStreamPresetField
 * @package App\Models
 */
class DataStreamPresetField extends ApiModel
{
	use UuidModelTrait;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'data_stream_preset_field';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'data_stream_preset_id',
		'name',
		'path',
		'versioned',
		'searchable',
		'to_retrieve'
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
		'data_stream_preset_id',
		'name',
		'path',
		'versioned',
		'searchable',
		'to_retrieve'
	];

	/**
	 * Model fillable fields for item patch
	 * @var array
	 */
	protected static $patchFillable = [
		'data_stream_preset_id',
		'name',
		'path',
		'versioned',
		'searchable',
		'to_retrieve'
	];

	/**
	 * Model fillable fields for item replacement
	 * @var array
	 */
	protected static $putFillable = [
		'data_stream_preset_id',
		'name',
		'path',
		'versioned',
		'searchable',
		'to_retrieve'
	];

	/**
	 * Model validation rules for new items
	 * @var string[]
	 */
	protected static $storeRules = [
		'data_stream_preset_id'     => 'required|uuid|exists:data_stream_preset,id',
		'name'                      => 'required|string|min:1|max:200',
		'path'                      => 'required|string|min:1|max:1000',
		'versioned'                 => 'required|boolean',
		'searchable'                => 'required|boolean',
		'to_retrieve'               => 'required|boolean',
	];

	/**
	 * Model validation rules for item patch
	 * @var string[]
	 */
	protected static $patchRules = [
		'data_stream_preset_id'     => 'uuid|exists:data_stream_preset,id',
		'name'                      => 'string|min:1|max:200',
		'path'                      => 'string|min:1|max:1000',
		'versioned'                 => 'boolean',
		'searchable'                => 'boolean',
		'to_retrieve'               => 'boolean',
	];

	/**
	 * Model validation rules for item replacement
	 * @var string[]
	 */
	protected static $putRules = [
		'data_stream_preset_id'     => 'required|uuid|exists:data_stream_preset,id',
		'name'                      => 'required|string|min:1|max:200',
		'path'                      => 'required|string|min:1|max:1000',
		'versioned'                 => 'required|boolean',
		'searchable'                => 'required|boolean',
		'to_retrieve'               => 'required|boolean',
	];

	/**
	 * Get the data stream preseet of this data stream preset field
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function dataStreamPreset()
	{
		return $this->belongsTo(DataStreamPreset::class);
	}
}
