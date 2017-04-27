<?php

namespace App\Models;

use App\Models\Project;
use App\Traits\HasCompositeKey;

/**
 * Class SyncItem
 * @package App\Models
 */
class SyncItem extends ApiModel
{
	use HasCompositeKey;

	/**
	 * The composite primary key for the model.
	 *
	 * @var string
	 */
	protected $primaryKey = ['item_id', 'project_id'];

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'sync_item';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'item_id',
		'project_id',
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
		'item_id'           => 'required|string|max:191|unique_with:sync_item,project_id',
		'project_id'        => 'required|uuid|exists:project,id',
		'item_signature'    => 'string|md5|size:32',
	];

	/**
	 * Model validation rules for item patch
	 * @var string[]
	 */
	protected static $patchRules = [
		'item_id'           => 'required|string|max:191|unique_with:sync_item,project_id',
		'project_id'        => 'required|uuid|exists:project,id',
		'item_signature'    => 'string|md5|size:32',
	];

	/**
	 * Model validation rules for item replacement
	 * @var string[]
	 */
	protected static $putRules = [
		'item_id'           => 'required|string|max:191|unique_with:sync_item,project_id',
		'project_id'        => 'required|uuid|exists:project,id',
		'item_signature'    => 'string|md5|size:32',
	];

	/**
	 * Get the project of this sync item
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function project()
	{
		return $this->belongsTo(Project::class);
	}
}
