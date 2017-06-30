<?php

namespace App\Models;

use App\Traits\HasCompositeKey;

/**
 * Class DataStreamHasI18nLang
 * @package App\Models
 */
class DataStreamHasI18nLang extends ApiModel
{
	use HasCompositeKey;

	/**
	 * The composite primary key for the model.
	 *
	 * @var string
	 */
	protected $primaryKey = ['data_stream_id', 'i18n_lang_id'];

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'data_stream_has_i18n_lang';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'data_stream_id',
		'i18n_lang_id',
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
	 * Model validation rules for new items
	 * @var string[]
	 */
	protected static $storeRules = [
		'data_stream_id'    => 'required|uuid|exists:data_stream,id|unique_with:data_stream_has_i18n_lang,i18n_lang_id',
		'i18n_lang_id'      => 'required|string|max:30|exists:i18n_lang,id',
	];

	/**
	 * Model validation rules for item patch
	 * @var string[]
	 */
	protected static $patchRules = [
		'data_stream_id'    => 'required|uuid|exists:data_stream,id|unique_with:data_stream_has_i18n_lang,i18n_lang_id',
		'i18n_lang_id'      => 'required|string|max:30|exists:i18n_lang,id',
	];

	/**
	 * Model validation rules for item replacement
	 * @var string[]
	 */
	protected static $putRules = [
		'data_stream_id'    => 'required|uuid|exists:data_stream,id|unique_with:data_stream_has_i18n_lang,i18n_lang_id',
		'i18n_lang_id'      => 'required|string|max:30|exists:i18n_lang,id',
	];

	/**
	 * Get the data stream of this relationship
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function dataStream()
	{
		return $this->belongsTo(DataStream::class);
	}

	/**
	 * Get the i18n lang of this relationship
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function i18nLang()
	{
		return $this->belongsTo(I18nLang::class);
	}
}
