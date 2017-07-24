<?php

use App\Models\SearchUseCase;
use Illuminate\Database\Seeder;

class SearchUseCaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    // John Smith Sample Project 1
	    SearchUseCase::create([
		    'id'            => '37f79df8-707c-11e7-8cf7-a6006ad3dba0',
		    'project_id'    => '1bcc7efc-138c-11e7-93ae-92361f002671', // John Smith Sample Project 1
		    'name'          => 'John Smith Sample Project Default Search Use Case',
	    ]);
    }
}
