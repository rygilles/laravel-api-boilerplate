<?php

namespace App\Models;

use App\Models\SyncTask;
use App\Traits\HasCompositeKey;

/**
 * Class SyncTaskItem
 * @package App\Models
 */
class SyncTaskItem extends ApiModel
{
	use HasCompositeKey;

	/**
	 * The composite primary key for the model.
	 *
	 * @var string
	 */
	protected $primaryKey = ['item_id', 'sync_task_id'];

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'sync_task_item';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'item_id',
		'sync_task_id',
		'data',
		'item_signature',
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
	 * Model validation rules for new items
	 * @var string[]
	 */
	protected static $storeRules = [
		'item_id'           => 'required|string|max:191|unique_with:sync_task_item,sync_task_id',
		'sync_task_id'      => 'required|uuid|exists:sync_task,id',
		//'data'              => '',
		'item_signature'    => 'string|md5|size:32',
	];

	/**
	 * Model validation rules for item patch
	 * @var string[]
	 */
	protected static $patchRules = [
		'item_id'           => 'required|string|max:191|unique_with:sync_task_item,sync_task_id',
		'sync_task_id'      => 'required|uuid|exists:sync_task,id',
		//'data'              => '',
		'item_signature'    => 'string|md5|size:32',
	];

	/**
	 * Model validation rules for item replacement
	 * @var string[]
	 */
	protected static $putRules = [
		'item_id'           => 'required|string|max:191|unique_with:sync_task_item,sync_task_id',
		'sync_task_id'      => 'required|uuid|exists:sync_task,id',
		//'data'              => '',
		'item_signature'    => 'string|md5|size:32',
	];

	/**
	 * "data" attribute magic getter (json encoded)
	 * @param $data
	 * @return mixed
	 */
	public function getDataAttribute($data)
	{
		return collect(json_decode($data,true));
	}

	/**
	 * "data attribute magic setter (json encode)
	 * @param $data
	 * @return mixed
	 */
	public function setDataAttribute($data)
	{
		$data = (is_array($data) || is_object($data)) ? json_encode($data) : $data;
		return $this->attributes['data'] = $data;
	}

	/**
	 * Get the sync task of this sync task item
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function syncTask()
	{
		return $this->belongsTo(SyncTask::class);
	}
}
