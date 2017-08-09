<?php

use App\Models\SearchUseCasePresetField;
use Illuminate\Database\Seeder;

class SearchUseCasePresetFieldTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    // E-monsite | Blog - Summary search use case preset fields

	    SearchUseCasePresetField::create([
		    'search_use_case_preset_id'         => '516f0252-7767-11e7-b5a5-be2e44b06b34',
		    'data_stream_preset_field_id'       => 'eb9cb642-5bf3-11e7-907b-a6006ad3dba0',
		    'name'                              => 'title',
		    'searchable'                        => true,
		    'to_retrieve'                       => true,
	    ]);

	    SearchUseCasePresetField::create([
		    'search_use_case_preset_id'         => '516f0252-7767-11e7-b5a5-be2e44b06b34',
		    'data_stream_preset_field_id'       => 'eb9cc4ca-5bf3-11e7-907b-a6006ad3dba0',
		    'name'                              => 'tags',
		    'searchable'                        => true,
		    'to_retrieve'                       => true,
	    ]);

	    SearchUseCasePresetField::create([
		    'search_use_case_preset_id'         => '516f0252-7767-11e7-b5a5-be2e44b06b34',
		    'data_stream_preset_field_id'       => 'eb9cc7c2-5bf3-11e7-907b-a6006ad3dba0',
		    'name'                              => 'url',
		    'searchable'                        => false,
		    'to_retrieve'                       => true,
	    ]);

	    // E-monsite | Blog - Photo search use case preset fields

	    SearchUseCasePresetField::create([
		    'search_use_case_preset_id'         => 'd3c73a6c-7767-11e7-b5a5-be2e44b06b34',
		    'data_stream_preset_field_id'       => 'eb9cb642-5bf3-11e7-907b-a6006ad3dba0',
		    'name'                              => 'title',
		    'searchable'                        => true,
		    'to_retrieve'                       => true,
	    ]);

	    SearchUseCasePresetField::create([
		    'search_use_case_preset_id'         => 'd3c73a6c-7767-11e7-b5a5-be2e44b06b34',
		    'data_stream_preset_field_id'       => 'eb9cc92a-5bf3-11e7-907b-a6006ad3dba0',
		    'name'                              => 'image_url',
		    'searchable'                        => false,
		    'to_retrieve'                       => true,
	    ]);
    }
}
