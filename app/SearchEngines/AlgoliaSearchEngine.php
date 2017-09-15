<?php

namespace App\SearchEngines;

use AlgoliaSearch\Index;
use App\Models\DataStream;
use App\Models\I18nLang;
use App\Models\Project;
use App\Models\SearchEngine as SearchEngineModel;
use App\Models\DataStreamField;
use AlgoliaSearch\Client as AlgoliaSearchClient;
use AlgoliaSearch\Index as AlgoliaSearchIndex;
use App\Models\SearchResult;
use App\Models\SearchResultCollection;
use App\Models\SearchResultResponse;
use App\Models\SearchUseCase;
use App\Models\SearchUseCaseField;
use App\Models\SyncItem;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class AlgoliaSearchEngine
 * @package App\SearchEngines
 */
class AlgoliaSearchEngine implements SearchEngine
{
	/**
	 * Project
	 * @var Project
	 */
	private $project = null;

	/**
	 * Search Engine Model instance
	 * @var SearchEngineModel
	 */
	private $searchEngineModel = null;

	/**
	 * Data Stream of the project
	 * @var DataStream
	 */
	private $dataStream = null;

	/**
	 * Algolia API Client
	 * @var AlgoliaSearchClient
	 */
	private $client = null;

	/**
	 * Aloglia API Index
	 * @var AlgoliaSearchIndex
	 */
	private $index = null;

	/**
	 * Aloglia Application Id
	 * @todo Store configuration inside SearchEngine model insteed.
	 * @var string
	 */
	private static $applicationID = 'VWGVDGN783';

	/**
	 * Algolia Admin API Key
	 * @todo Store configuration inside SearchEngine model insteed.
	 * @var string
	 */
	private static $adminAPIKey = 'b237efc5a75573a2763d0b8fb6db168c';

	/**
	 * AlgoliaSearchEngine constructor.
	 * @param Project $project
	 */
	public function __construct(Project $project) {
		$this->project = $project;
		$this->searchEngineModel = $project->searchEngine()->first();
		$this->dataStream = $project->dataStream()->first();
	}

	/**
	 * Initialize the search engine client
	 */
	public function initClient() {
		// @todo Use stored configuration inside $searchEngine instead of using static constants.

		// Only if not initiated yet
		if (is_null($this->client)) {
			$this->client = new \AlgoliaSearch\Client(static::$applicationID, static::$adminAPIKey);
		}
	}

	/**
	 * Initialize the project data container in the search engine service
	 * Use project data stream uuid as container id
	 */
	public function initProjectContainer() {
		// Init Algolia Index

		/** @var Index $index */
		$this->index = $this->client->initIndex($this->getClientContainerName($this->dataStream));

		/** @var DataStreamField[] $dataStreamFields */
		$dataStreamFields = $this->dataStream->dataStreamFields()->get();

		/** @var i18nLang[] $i18nLangs */
		$i18nLangs = $this->dataStream->i18nLangs()->get();

		// Make "searchableAttributes", "attributesToRetrieve" fields

		/** @var string[] $searchableAttributes */
		$searchableAttributes = [];

		/** @var string[] $attributesToRetrieve */
		$attributesToRetrieve = [];

		foreach ($dataStreamFields as $dataStreamField) {
			if ($dataStreamField->versioned) {
				foreach ($i18nLangs as $i18nLang) {
					$field_name = $this->getClientContainerFieldName($dataStreamField, $i18nLang->id);
					if ($dataStreamField->searchable) {
						$searchableAttributes[] = $field_name;
					}
					if ($dataStreamField->to_retrieve) {
						$attributesToRetrieve[] = $field_name;
					}
				}
			} else {
				$field_name = $this->getClientContainerFieldName($dataStreamField);

				if ($dataStreamField->searchable) {
					$searchableAttributes[] = $field_name;
				}
				if ($dataStreamField->to_retrieve) {
					$attributesToRetrieve[] = $field_name;
				}
			}
		}

		// @todo customRanking

		// Configure index
		$this->index->setSettings([
			'searchableAttributes' => $searchableAttributes,
			'attributesToRetrieve' => $attributesToRetrieve,
		]);
	}

	/**
	 * Return the data stream name in the client container
	 * @return string
	 */
	public function getClientContainerName() {
		return $this->dataStream->id;
	}

	/**
	 * Return the data stream field name in the client container
	 * @param DataStreamField $dataStreamField
	 * @param string|null $i18nLangId
	 * @return string
	 */
	public function getClientContainerFieldName(DataStreamField $dataStreamField, $i18nLangId = null) {
		// Use field UUID as name in client container
		$name = $dataStreamField->id;

		// Contained with (dot before) i18n lang id (locale) if the field is versioned and a value is specified
		if (!is_null($i18nLangId) && $dataStreamField->versioned) {
			$name .= '.' . $i18nLangId;
		}

		return $name;
	}

	/**
	 * Return the data stream field corresponding to the client container field name
	 * @param string $field_name
	 * @return DataStreamField|null
	 */
	public function resolveClientContainerFieldName($field_name) {
		if (strstr($field_name, '.')) {
			list($field_id, $i18n_lang_id) = explode('.', $field_name);
		} else {
			$field_id = $field_name;
		}

		return $this->dataStream->dataStreamFields()->find($field_id);
	}

	/**
	 * Return the i18n lang id corresponding to the client container field name
	 * @param string $field_name
	 * @@return string|null
	 */
	public function resolveClientContainerFieldNameI18nLangId($field_name) {
		if (!(strstr($field_name, '.'))) {
			return null;
		}

		list($field_id, $i18n_lang_id) = explode('.', $field_name);

		return $i18n_lang_id;
	}

	/**
	 * Create new items
	 * @param Collection $syncTaskItems
	 */
	public function createItems(Collection $syncTaskItems) {
		// Make Algolia items

		$algoliaItems = [];

		foreach ($syncTaskItems as $syncTaskItem) {
			$algoliaItem = [];
			$algoliaItem['objectID'] = $syncTaskItem->item_id;

			$data = $syncTaskItem->data;

			foreach ($data as $dataFieldId => $dataFieldValue) {
				$algoliaItem[$dataFieldId] = $dataFieldValue;
			}

			$algoliaItems[] = $algoliaItem;
		}

		// Insert algolia items

		$this->index->addObjects($algoliaItems);

		// Insert or update items signature

		foreach ($syncTaskItems as $syncTaskItem) {
			$syncItem = $this->project->syncItems()->firstOrNew(['item_id' => $syncTaskItem->item_id]);
			$syncItem->item_signature = $syncTaskItem->item_signature;
			$syncItem->save();
			// @todo when to remove temp sync task items ? now or after computing items to delete !!!
		}
	}

	/**
	 * Update items
	 * @param Collection $syncTaskItems
	 */
	public function updateItems(Collection $syncTaskItems) {
		// Make Algolia items

		$algoliaItems = [];

		foreach ($syncTaskItems as $syncTaskItem) {
			$algoliaItem = [];
			$algoliaItem['objectID'] = $syncTaskItem->item_id;

			$data = $syncTaskItem->data;

			foreach ($data as $dataFieldId => $dataFieldValue) {
				$algoliaItem[$dataFieldId] = $dataFieldValue;
			}

			$algoliaItems[] = $algoliaItem;
		}

		// Insert algolia items

		$this->index->saveObject($algoliaItems);

		// Insert or update items signature

		foreach ($syncTaskItems as $syncTaskItem) {
			$syncItem = $this->project->syncItems()->firstOrNew(['item_id' => $syncTaskItem->item_id]);
			$syncItem->item_signature = $syncTaskItem->item_signature;
			$syncItem->save();
			// @todo when to remove temp sync task items ? now or after computing items to delete !!!
		}
	}

	/**
	 * Delete items
	 * @param Collection $syncTaskItems
	 */
	public function deleteItems(Collection $syncTaskItems) {
		$syncTaskItemsIds = $syncTaskItems->keyBy('item_id')->keys();

		$this->index->deleteObjects($syncTaskItemsIds);
	}

	/**
	 * Perform search
	 * @param SearchUseCase $searchUseCase
	 * @param string $query_string
	 * @param I18nLang|null $i18nLang
	 * @param int $page
	 * @param int $limit
	 * @return SearchResultResponse
	 * @throws \AlgoliaSearch\AlgoliaException
	 * @throws \Exception
	 */
	public function performSearch(SearchUseCase $searchUseCase, $query_string, I18nLang $i18nLang = null, $page = 1, $limit = 20)
	{
		// Init Algolia Index

		/** @var Index $index */
		$this->index = $this->client->initIndex($this->getClientContainerName($this->dataStream));

		/** @var SearchUseCaseField[] $searchUseCaseFields */
		$searchUseCaseFields = $searchUseCase->searchUseCaseFields()->get();

		// Make "searchableAttributes", "attributesToRetrieve" fields

		/** @var string[] $searchableAttributes */
		$searchableAttributes = [];

		/** @var string[] $attributesToRetrieve */
		$attributesToRetrieve = [];

		foreach ($searchUseCaseFields as $searchUseCaseField) {

			// Get the data stream field

			/** @var DataStreamField $dataStreamField */
			$dataStreamField = $searchUseCaseField->dataStreamField()->first();

			if ($dataStreamField->versioned) {
				if (is_null($i18nLang)) {
					throw new \Exception('Versioned search use case field requested without i18n lang specified');
				}

				$client_container_field_name = $this->getClientContainerFieldName($dataStreamField, $i18nLang->id);
				if ($searchUseCaseField->searchable) {
					$searchableAttributes[] = $client_container_field_name;
				}
				if ($searchUseCaseField->to_retrieve) {
					$attributesToRetrieve[] = $client_container_field_name;
				}
			} else {
				$client_container_field_name = $this->getClientContainerFieldName($dataStreamField);

				if ($searchUseCaseField->searchable) {
					$searchableAttributes[] = $client_container_field_name;
				}
				if ($searchUseCaseField->to_retrieve) {
					$attributesToRetrieve[] = $client_container_field_name;
				}
			}
		}

		// @todo customRanking

		/**/

		$algoliaResult = $this->index->search($query_string, [
			'attributesToRetrieve' => $attributesToRetrieve,
			'restrictSearchableAttributes' => $searchableAttributes,
			'attributesToHighlight' => $attributesToRetrieve,
			'page' => $page,
			'hitsPerPage' => $limit,
		]);

		$searchResultCollection = new SearchResultCollection();

		foreach ($algoliaResult['hits'] as $hit) {
			$attributes = [];

			$attributes['item_id'] = $hit['objectID'];

			foreach ($searchUseCaseFields as $searchUseCaseField) {

				// Get the data stream field

				/** @var DataStreamField $dataStreamField */
				$dataStreamField = $searchUseCaseField->dataStreamField()->first();

				if ($dataStreamField->versioned) {
					$client_container_field_name = $this->getClientContainerFieldName($dataStreamField, $i18nLang->id);

					if ($searchUseCaseField->to_retrieve) {
						$attributes[$searchUseCaseField->name . '_' . $i18nLang->id] = $hit[$client_container_field_name];
					}
				} else {
					$client_container_field_name = $this->getClientContainerFieldName($dataStreamField);

					if ($searchUseCaseField->to_retrieve) {
						$attributes[$searchUseCaseField->name] = $hit[$client_container_field_name];
					}
				}
			}

			$searchResult = new SearchResult($attributes);
			$searchResultCollection->push($searchResult);
		}

		$content = [
			'data' => $searchResultCollection,
			'meta' => [
				'pagination' => [
					'total' => $algoliaResult['nbHits'],
					'count' => $searchResultCollection->count(),
					'per_page' => $algoliaResult['hitsPerPage'],
					'current_page' => $algoliaResult['page'],
					'total_pages' => $algoliaResult['nbPages'],
				]
			]
		];

		//dd($algoliaResult);

		$searchResultResponse = new SearchResultResponse($content);

		return $searchResultResponse;
	}
}