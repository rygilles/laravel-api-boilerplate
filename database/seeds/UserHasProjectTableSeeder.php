<?php

use Illuminate\Database\Seeder;
use App\Models\UserHasProject;

class UserHasProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    // John Smith -> (Owner) -> John Smith Sample Project 1
        UserHasProject::create([
            'user_id'       => '605c7610-1389-11e7-93ae-92361f002671',
            'project_id'    => '1bcc7efc-138c-11e7-93ae-92361f002671',
	        'user_role_id'  => 'Owner'
        ]);

	    // John Smith -> (Owner) -> John Smith Sample Project 2
	    UserHasProject::create([
		    'user_id'       => '605c7610-1389-11e7-93ae-92361f002671',
		    'project_id'    => 'b6860dd2-138c-11e7-93ae-92361f002671',
		    'user_role_id'  => 'Owner'
	    ]);

	    // Mickey Mouse -> (Owner) -> Mickey Mouse Sample Project
	    UserHasProject::create([
		    'user_id'       => '82b5da82-138c-11e7-93ae-92361f002671',
		    'project_id'    => 'c4b5d93c-138c-11e7-93ae-92361f002671',
		    'user_role_id'  => 'Owner'
	    ]);

	    // Mickey Mouse -> (Administrator) -> John Smith Sample Project 1
	    UserHasProject::create([
		    'user_id'       => '82b5da82-138c-11e7-93ae-92361f002671',
		    'project_id'    => '1bcc7efc-138c-11e7-93ae-92361f002671',
		    'user_role_id'  => 'Administrator'
	    ]);
    }
}
