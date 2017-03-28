<?php

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::create([
            'id'                => '1bcc7efc-138c-11e7-93ae-92361f002671',
            'search_engine_id'  => 'ee87e3b2-1388-11e7-93ae-92361f002671',
            'name'              => 'John Smith Sample Project 1',
        ]);

        Project::create([
            'id'                => 'b6860dd2-138c-11e7-93ae-92361f002671',
            'search_engine_id'  => 'ee87e3b2-1388-11e7-93ae-92361f002671',
            'name'              => 'John Smith Sample Project 2',
        ]);

	    Project::create([
		    'id'                => 'c4b5d93c-138c-11e7-93ae-92361f002671',
		    'search_engine_id'  => 'ee87e3b2-1388-11e7-93ae-92361f002671',
		    'name'              => 'Mickey Mouse Sample Project',
	    ]);
    }
}
