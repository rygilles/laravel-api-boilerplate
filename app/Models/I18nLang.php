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
	 * Pagination limit inclusive max value
	 * @var int
	 */
	protected $perPageMax = 50;

	/**
	 * Model fillable fields for new items
	 * @var array
	 */
	protected static $storeFillable = [
		'id',
		'description',
	];

	/**
	 * Model fillable fields for item patch
	 * @var array
	 */
	protected static $patchFillable = [
		'description',
	];

	/**
	 * Model fillable fields for item replacement
	 * @var array
	 */
	protected static $putFillable = [
		'description',
	];

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
	 * Get the sync task type versions
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function syncTaskTypeVersions()
	{
		return $this->HasMany(SyncTaskTypeVersion::class);
	}

	/**
	 * Get the sync task status versions
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function syncTaskStatusVersions()
	{
		return $this->HasMany(SyncTaskStatus::class);
	}

	/**
	 * Get the relationships between this i18n lang and his data streams
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function dataStreamHasI18nLangs()
	{
		return $this->hasMany(DataStreamHasI18nLang::class);
	}

	/**
	 * Get the data streams of this i18n lang using relationship table
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function dataStreams()
	{
		return $this->belongsToMany(DataStream::class, 'data_stream_has_i18n_lang', 'i18n_lang_id', 'data_stream_id');
	}
}
