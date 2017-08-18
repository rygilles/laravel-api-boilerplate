<?php

namespace App\Models;

use Alsofronie\Uuid\UuidModelTrait;
use Illuminate\Support\Facades\Auth;

/**
 * Class Widget
 * @package App\Models
 */
class Widget extends ApiModel
{
	use UuidModelTrait;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'widget';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'search_use_case_id',
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
		'search_use_case_id',
		'name',
	];

	/**
	 * Model fillable fields for item patch
	 * @var array
	 */
	protected static $patchFillable = [
		'search_use_case_id',
		'name',
	];

	/**
	 * Model fillable fields for item replacement
	 * @var array
	 */
	protected static $putFillable = [
		'search_use_case_id',
		'name',
	];

	/**
	 * Model validation rules for new items
	 * @var string[]
	 */
	protected static $storeRules = [
		'search_use_case_id'    => 'required|uuid|exists:search_use_case,id',
		'name'                  => 'required|string|min:5|max:200'
	];

	/**
	 * Model validation rules for item patch
	 * @var string[]
	 */
	protected static $patchRules = [
		'search_use_case_id'    => 'uuid|exists:search_use_case,id',
		'name'                  => 'string|min:5|max:200'
	];

	/**
	 * Model validation rules for item replacement
	 * @var string[]
	 */
	protected static $putRules = [
		'search_use_case_id'    => 'required|uuid|exists:search_use_case,id',
		'name'                  => 'required|string|min:5|max:200'
	];

	/**
	 * Get the search use case of this widget
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function searchUseCase()
	{
		return $this->belongsTo(SearchUseCase::class);
	}

	/**
	 * Scope a query to include authorized access
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string[] $authorizedUserRolesIds User roles ids authorized to access to this route/resource
	 * @param string[] $exceptUserGroupsIds User groups ids authorized to access to this route
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeAuthorized($query, $authorizedUserRolesIds = ['Owner', 'Administrator'], $exceptUserGroupsIds = ['Developer', 'Support'])
	{
		// Apply query scope if user group id isn't authorized
		if (!in_array(Auth::user()->user_group_id, $exceptUserGroupsIds)) {
			return $query->whereHas('searchUseCase.project.hasUserProjects', function ($query) use ($authorizedUserRolesIds) {
				$query->where('user_id', Auth::user()->id)
					->whereIn('user_role_id', $authorizedUserRolesIds);
			});
		}

		return $query;
	}

	// @todo widgetIntegrations
}
