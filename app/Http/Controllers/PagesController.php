<?php

namespace App\Http\Controllers;

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
        $this->middleware('emailConfirm');
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

    /**
     * Show PHPInfo (for debug purpose... to remove).
     */
    public function phpinfo()
    {
        phpinfo();
        die();
    }
}
