<?php

namespace App\SearchEngines;

use App\Models\I18nLang;
use App\Models\Project;
use App\Models\DataStreamField;
use App\Models\SearchResultCollection;
use App\Models\SearchUseCase;
use Illuminate\Database\Eloquent\Collection;

/**
 * Decoder interface for SearchEngine classes
 * @package App\SearchEngines
 */
interface SearchEngine
{
	/**
	 * AlgoliaSearchEngine constructor.
	 * @param Project $project
	 */
	public function __construct(Project $project);

	/**
	 * Initialize the search engine client
	 */
	public function initClient();

	/**
	 * Initialize the project data container in the search engine service
	 * Use project data stream uuid as container id
	 */
	public function initProjectContainer();

	/**
	 * Return the data stream name in the client container
	 * @return string
	 */
	public function getClientContainerName();

	/**
	 * Return the data stream field name in the client container
	 * @param DataStreamField $dataStreamField
	 * @param string|null $i18nLangId
	 * @return string
	 */
	public function getClientContainerFieldName(DataStreamField $dataStreamField, $i18nLangId = null);

	/**
	 * Return the data stream field corresponding to the client container field name
	 * @param string $field_name
	 * @return DataStreamField|null
	 */
	public function resolveClientContainerFieldName($field_name);
	/**
	 * Return the i18n lang id corresponding to the client container field name
	 * @param string $field_name
	 * @@return string|null
	 */
	public function resolveClientContainerFieldNameI18nLangId($field_name);

	/**
	 * Create new items
	 * @param Collection $syncTaskItems
	 */
	public function createItems(Collection $syncTaskItems);

	/**
	 * Update items
	 * @param Collection $syncTaskItems
	 */
	public function updateItems(Collection $syncTaskItems);

	/**
	 * Delete items
	 * @param Collection $syncTaskItems
	 */
	public function deleteItems(Collection $syncTaskItems);

	/**
	 * Perform search
	 * @param SearchUseCase $searchUseCase
	 * @param string $query_string
	 * @param I18nLang|null $i18nLang
	 * @param int $page
	 * @param int $limit
	 * @return SearchResultResponse
	 */
	public function performSearch(SearchUseCase $searchUseCase, $query_string, I18nLang $i18nLang = null, $page = 1, $limit = 20);
}