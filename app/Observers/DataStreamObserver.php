<?php

namespace App\Observers;

use App\Models\DataStream;

class DataStreamObserver
{
	/**
	 * Listen to the Data stream deleting event.
	 *
	 * @param  DataStream  $dataStream
	 * @return void
	 */
	public function deleting(DataStream $dataStream)
	{
		// Delete project data stream data stream has i18n langs
		foreach ($dataStream->dataStreamHasI18nLangs()->get() as $dataStreamHasI18nLang) {
			$dataStreamHasI18nLang->delete();
		}

		// Delete project data stream fields
		foreach ($dataStream->dataStreamFields()->get() as $dataStreamField) {
			$dataStreamField->delete();
		}
	}
}