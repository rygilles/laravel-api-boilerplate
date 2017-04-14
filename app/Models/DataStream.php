<?php

namespace App\Models;

use Alsofronie\Uuid\UuidModelTrait;

/**
 * Class DataStream
 * @package App\Models
 */
class DataStream extends ApiModel
{
	use UuidModelTrait;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'data_stream';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'feed_url'
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
		'name'      => 'required|string|max:200',
		'feed_url'  => 'required|url'
	];

	/**
	 * Model validation rules for item patch
	 * @var string[]
	 */
	protected static $patchRules = [
		'name'      => 'string|max:200',
		'feed_url'  => 'url'
	];

	/**
	 * Model validation rules for item replacement
	 * @var string[]
	 */
	protected static $putRules = [
		'name'      => 'required|string|max:200',
		'feed_url'  => 'required|url'
	];

	/**
	 * Get the project of this data stream
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\hasOne
	 */
	public function project()
	{
		return $this->hasOne('App\Models\Project');
	}
}
