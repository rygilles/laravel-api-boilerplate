<?php

namespace App\Http\Controllers;


use App\Models\UserHasProject;
use App\Notifications\AdministeredProject;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('home');
	}

	/**
	 * Show the dashboard view.
	 */
	public function dashboard()
	{
		// @todo Remove this test...
		/*
		$user = Auth::user();

		$userHasProject = UserHasProject::where('user_id', '82b5da82-138c-11e7-93ae-92361f002671')
			->where('project_id', '1bcc7efc-138c-11e7-93ae-92361f002671')
			->first();

		$user->notify(new AdministeredProject($userHasProject->user()->first(), $userHasProject->project()->first(), $user));
		*/
		return view('dashboard');
	}
}
