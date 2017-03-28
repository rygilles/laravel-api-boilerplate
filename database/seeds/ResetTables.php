<?php

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\I18nLang;
use App\Models\SearchEngine;
use App\Models\UserRole;

class ResetTables extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // /!\ Reset all tables data (using models tables dependencies)

	    foreach (User::all() as $user) {
		    $user->delete();
	    }

	    foreach (I18nLang::all() as $i18nLang) {
		    $i18nLang->delete();
	    }

	    foreach (SearchEngine::all() as $searchEngine) {
		    $searchEngine->delete();
	    }

	    foreach (UserRole::all() as $userRole) {
		    $userRole->delete();
	    }
    }
}
