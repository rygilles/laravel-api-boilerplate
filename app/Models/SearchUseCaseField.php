<?php

namespace App\Models;

use App\Traits\HasCompositeKey;

/**
 * Class SearchUseCaseField
 * @package App\Models
 */
class SearchUseCaseField extends ApiModel
{
	use HasCompositeKey;

	/**
	 * The composite primary key for the model.
	 *
	 * @var string
	 */
	protected $primaryKey = ['search_use_case_id', 'data_stream_field_id'];

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'search_use_case_field';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'search_use_case_id',
		'data_stream_field_id',
		'name',
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
	 * Pagination limit inclusive max value
	 * @var int
	 */
	protected $perPageMax = 50;

	/**
	 * Model fillable fields for new items
	 * @var array
	 */
	protected static $storeFillable = [
		'search_use_case_id',
		'data_stream_field_id',
		'name',
		'searchable',
		'to_retrieve'
	];

	/**
	 * Model fillable fields for item patch
	 * @var array
	 */
	protected static $patchFillable = [
		'search_use_case_id',
		'data_stream_field_id',
		'name',
		'searchable',
		'to_retrieve'
	];

	/**
	 * Model fillable fields for item replacement
	 * @var array
	 */
	protected static $putFillable = [
		'search_use_case_id',
		'data_stream_field_id',
		'name',
		'searchable',
		'to_retrieve'
	];

	/**
	 * Model validation rules for new items
	 * @var string[]
	 */
	protected static $storeRules = [
		'search_use_case_id'        => 'required|uuid|exists:search_use_case,id',
		'data_stream_field_id'      => 'required|uuid|exists:data_stream_field,id',
		'name'                      => 'required|string|min:1|max:200',
		'searchable'                => 'required|boolean',
		'to_retrieve'               => 'required|boolean',
	];

	/**
	 * Model validation rules for item patch
	 * @var string[]
	 */
	protected static $patchRules = [
		'search_use_case_id'        => 'uuid|exists:search_use_case,id',
		'data_stream_field_id'      => 'uuid|exists:data_stream_field,id',
		'name'                      => 'required|string|min:1|max:200',
		'searchable'                => 'required|boolean',
		'to_retrieve'               => 'required|boolean',
	];

	/**
	 * Model validation rules for item replacement
	 * @var string[]
	 */
	protected static $putRules = [
		'search_use_case_id'        => 'required|uuid|exists:search_use_case,id',
		'data_stream_field_id'      => 'required|uuid|exists:data_stream_field,id',
		'name'                      => 'required|string|min:1|max:200',
		'searchable'                => 'required|boolean',
		'to_retrieve'               => 'required|boolean',
	];

	/**
	 * Get the search use case of this relationship
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function searchUseCase()
	{
		return $this->belongsTo(SearchUseCase::class);
	}

	/**
	 * Get the data stream field of this relationship
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function dataStreamField()
	{
		return $this->belongsTo(DataStreamField::class);
	}
}
