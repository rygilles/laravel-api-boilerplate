<?php

namespace App\Observers;

use App\Models\SearchUseCase;

class SearchUseCaseObserver
{
	/**
	 * Listen to the Sync task deleting event.
	 *
	 * @param  SearchUseCase  $searchUseCase
	 * @return void
	 */
	public function deleting(SearchUseCase $searchUseCase)
	{
		// Delete search use case fields
		foreach ($searchUseCase->searchUseCaseFields()->get() as $searchUseCaseField) {
			$searchUseCaseField->delete();
		}

		// Delete widgets
		foreach ($searchUseCase->widgets()->get() as $widget) {
			$widget->delete();
		}
	}
}