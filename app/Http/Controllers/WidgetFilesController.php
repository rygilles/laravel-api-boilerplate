<?php

namespace App\Http\Controllers;


/**
 * Class WidgetFilesController
 *
 * Manage widget public files access and CORS
 *
 * @package App\Http\Controllers
 */
class WidgetFilesController extends Controller
{
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getFile($path)
	{
		return response()->download(storage_path('app/widgets/public/' . $path), null, [], null);
	}
}
