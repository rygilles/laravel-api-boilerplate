<?php

namespace App\Models;

use Alsofronie\Uuid\UuidModelTrait;

/**
 * Class DataStreamDecoder
 * @package App\Models
 */
class DataStreamDecoder extends ApiModel
{
	use UuidModelTrait;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'data_stream_decoder';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'class_name',
		'file_mime_type'
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
		'name',
		'class_name',
		'file_mime_type'
	];

	/**
	 * Model fillable fields for item patch
	 * @var array
	 */
	protected static $patchFillable = [
		'name',
		'class_name',
		'file_mime_type'
	];

	/**
	 * Model fillable fields for item replacement
	 * @var array
	 */
	protected static $putFillable = [
		'name',
		'class_name',
		'file_mime_type'
	];

	/**
	 * Model validation rules for new items
	 * @var string[]
	 */
	protected static $storeRules = [
		'name'              => 'required|string|min:5|max:200',
		'class_name'        => 'required|string|data_stream_decoder_class_name',
		'file_mime_type'    => 'required|string', // @todo
	];

	/**
	 * Model validation rules for item patch
	 * @var string[]
	 */
	protected static $patchRules = [
		'name'              => 'required|string|min:5|max:200',
		'class_name'        => 'required|string|data_stream_decoder_class_name',
		'file_mime_type'    => 'required|string', // @todo
	];

	/**
	 * Model validation rules for item replacement
	 * @var string[]
	 */
	protected static $putRules = [
		'name'              => 'required|string|min:5|max:200',
		'class_name'        => 'required|string|data_stream_decoder_class_name',
		'file_mime_type'    => 'required|string', // @todo
	];

	/**
	 * Get the data stream presets
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function dataStreamPresets()
	{
		return $this->HasMany(DataStreamPreset::class);
	}

	/**
	 * Get the data stream
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function dataStreams()
	{
		return $this->HasMany(DataStream::class);
	}
}
