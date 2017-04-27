<?php

namespace App\Models;

use App\Models\SyncTaskStatus;
use App\Traits\HasCompositeKey;

/**
 * Class SyncTaskStatusVersion
 * @package App\Models
 */
class SyncTaskStatusVersion extends ApiModel
{
	use HasCompositeKey;

	/**
	 * The composite primary key for the model.
	 *
	 * @var string
	 */
	protected $primaryKey = ['sync_task_status_id', 'i18n_lang_id'];

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'sync_task_status_v';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'sync_task_status_id',
		'i18n_lang_id',
		'description'
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
	 * @var array
	 */
	protected static $storeRules = [
		'sync_task_status_id'   => 'required|string|max:50|exists:sync_task_status,id|unique_with:sync_task_status_version,i18n_lang_id',
		'i18n_lang_id'          => 'required|string|max:30|exists:i18n_lang,id',
		'description'           => 'required|string'
	];

	/**
	 * Model validation rules for item patch
	 * @var array
	 */
	protected static $patchRules = [
		'sync_task_status_id'   => 'string|max:50|exists:sync_task_status,id|unique_with:sync_task_status_version,i18n_lang_id',
		'i18n_lang_id'          => 'string|max:30|exists:i18n_lang,id',
		'description'   => 'string'
	];

	/**
	 * Model validation rules for item replacement
	 * @var array
	 */
	protected static $putRules = [
		'sync_task_status_id'   => 'required|string|max:50|exists:sync_task_status,id|unique_with:sync_task_status_version,i18n_lang_id',
		'i18n_lang_id'          => 'required|string|max:30|exists:i18n_lang,id',
		'description'           => 'required|string'
	];

	/**
	 * Get the parent sync task status
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function syncTaskStatus()
	{
		return $this->belongsTo(SyncTaskStatus::class);
	}
}