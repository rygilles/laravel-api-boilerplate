<?php

namespace App\Models;

use Alsofronie\Uuid\UuidModelTrait;
use Illuminate\Support\Facades\Auth;

/**
 * Class SearchUseCase
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

	/**
	 * Get the search use case fields of this search use case
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function searchUseCaseFields()
	{
		return $this->hasMany(SearchUseCaseField::class);
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
			return $query->whereHas('project.hasUserProjects', function ($query) use ($authorizedUserRolesIds) {
				$query->where('user_id', Auth::user()->id)
					->whereIn('user_role_id', $authorizedUserRolesIds);
			});
		}

		return $query;
	}

	/**
	 * Perform search on this search use case
	 *
	 * @param string $query_string
	 * @param string $i18n_lang_id
	 * @param int $page
	 * @param int $limit
	 * @return SearchResultResponse
	 * @throws \Exception
	 */
	public function search($query_string, $i18n_lang_id = null, $page = 1, $limit = 20)
	{
		// Get the project

		/** @var Project $project */
		$project = $this->project()->first();
		
		// Get the project search engine model

		/** @var SearchEngine $searchEngineModel */
		$searchEngineModel = $project->searchEngine()->first();

		// Check the search engine class

		$searchEngineClass = 'App\\SearchEngines\\' . $searchEngineModel->class_name;

		if (!class_exists($searchEngineClass)) {
			throw new \Exception('Search Engine "' . $searchEngineModel->class_name . '" class not found in App\\SearchEngines namespace');
		}

		/** @var \App\SearchEngines\SearchEngine $searchEngine */
		$searchEngine = new $searchEngineClass($project);
		
		$i18nLang = I18nLang::find($i18n_lang_id);

		$searchEngine->initClient();
		$searchResultResponse = $searchEngine->performSearch($this, $query_string, $i18nLang, $page, $limit);

		return $searchResultResponse;
	}
}
