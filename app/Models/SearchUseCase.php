<?php

namespace App\Models;

use Alsofronie\Uuid\UuidModelTrait;
use App\Models\Project;
use App\Traits\HasCompositeKey;

/**
 * Class SearchUseCase
 * @todo API Controllers, routes, docs, etc.
 * @package App\Models
 */
class SearchUseCase extends ApiModel
{
	use UuidModelTrait;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'search_use_case';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'project_id',
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
		'project_id',
		'name',
	];

	/**
	 * Model fillable fields for item patch
	 * @var array
	 */
	protected static $patchFillable = [
		'project_id',
		'name',
	];

	/**
	 * Model fillable fields for item replacement
	 * @var array
	 */
	protected static $putFillable = [
		'project_id',
		'name',
	];

	/**
	 * Model validation rules for new items
	 * @var string[]
	 */
	protected static $storeRules = [
		'project_id'    => 'required|uuid|exists:project,id',
		'name'          => 'required|string|min:5|max:200'
	];

	/**
	 * Model validation rules for item patch
	 * @var string[]
	 */
	protected static $patchRules = [
		'project_id'    => 'uuid|exists:project,id',
		'name'          => 'string|min:5|max:200'
	];

	/**
	 * Model validation rules for item replacement
	 * @var string[]
	 */
	protected static $putRules = [
		'project_id'    => 'required|uuid|exists:project,id',
		'name'          => 'required|string|min:5|max:200'
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
