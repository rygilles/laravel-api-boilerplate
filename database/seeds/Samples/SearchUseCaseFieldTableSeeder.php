<?php

use App\Models\SearchUseCaseField;
use Illuminate\Database\Seeder;

class SearchUseCaseFieldTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    // John Smith Sample Project Default Search Use Case fields

	    SearchUseCaseField::create([
		    'search_use_case_id'        => '37f79df8-707c-11e7-8cf7-a6006ad3dba0',
		    'data_stream_field_id'      => '145ca4a6-60af-11e7-907b-a6006ad3dba0',
		    'name'                      => 'title',
		    'searchable'                => true,
		    'to_retrieve'               => true,
	    ]);

	    SearchUseCaseField::create([
		    'search_use_case_id'        => '37f79df8-707c-11e7-8cf7-a6006ad3dba0',
		    'data_stream_field_id'      => '145ca730-60af-11e7-907b-a6006ad3dba0',
		    'name'                      => 'content',
		    'searchable'                => false,
		    'to_retrieve'               => true,
	    ]);

	    SearchUseCaseField::create([
		    'search_use_case_id'        => '37f79df8-707c-11e7-8cf7-a6006ad3dba0',
		    'data_stream_field_id'      => '145cade8-60af-11e7-907b-a6006ad3dba0',
		    'name'                      => 'url',
		    'searchable'                => false,
		    'to_retrieve'               => true,
	    ]);

	    // Mickey Mouse Sample Project Data Stream Use Case fields

	    SearchUseCaseField::create([
		    'search_use_case_id'        => 'dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0',
		    'data_stream_field_id'      => '36116fa6-5c0d-11e7-907b-a6006ad3dba0',
		    'name'                      => 'title',
		    'searchable'                => true,
		    'to_retrieve'               => true,
	    ]);

	    SearchUseCaseField::create([
		    'search_use_case_id'        => 'dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0',
		    'data_stream_field_id'      => '36117334-5c0d-11e7-907b-a6006ad3dba0',
		    'name'                      => 'content',
		    'searchable'                => false,
		    'to_retrieve'               => true,
	    ]);

	    SearchUseCaseField::create([
		    'search_use_case_id'        => 'dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0',
		    'data_stream_field_id'      => '36118072-5c0d-11e7-907b-a6006ad3dba0',
		    'name'                      => 'url',
		    'searchable'                => false,
		    'to_retrieve'               => true,
	    ]);
    }
}
