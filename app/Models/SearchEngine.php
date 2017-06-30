<?php

namespace App\Models;

use Alsofronie\Uuid\UuidModelTrait;
use App\Models\Project;

/**
 * Class SearchEngine
 * @package App\Models
 */
class SearchEngine extends ApiModel
{
	use UuidModelTrait;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'search_engine';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'class_name',
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
	];

	/**
	 * Model fillable fields for item patch
	 * @var array
	 */
	protected static $patchFillable = [
		'name',
		'class_name',
	];

	/**
	 * Model fillable fields for item replacement
	 * @var array
	 */
	protected static $putFillable = [
		'name',
		'class_name',
	];

	/**
	 * Model validation rules for new items
	 * @var string[]
	 */
	protected static $storeRules = [
		'name'              => 'required|string|max:100',
		'class_name'        => 'required|string|search_engine_class_name',
	];

	/**
	 * Model validation rules for item patch
	 * @var string[]
	 */
	protected static $patchRules = [
		'name'              => 'string|max:100',
		'class_name'        => 'string|search_engine_class_name',
	];

	/**
	 * Model validation rules for item replacement
	 * @var string[]
	 */
	protected static $putRules = [
		'name'              => 'required|string|max:100',
		'class_name'        => 'required|string|search_engine_class_name',
	];

	/**
	 * Get the projects of this search engine
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function projects()
	{
		return $this->hasMany(Project::class);
	}
}
