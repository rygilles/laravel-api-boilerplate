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
		return view('dashboard');
	}

	public function phpinfo()
	{
		phpinfo();
		die();
	}
}
