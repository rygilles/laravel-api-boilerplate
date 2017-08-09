<?php

use App\Models\SearchUseCasePreset;
use Illuminate\Database\Seeder;

class SearchUseCasePresetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // E-monsite | Blog - Summary
	    SearchUseCasePreset::create([
		    'id'                        => '516f0252-7767-11e7-b5a5-be2e44b06b34',
		    'data_stream_preset_id'     => '737441b0-57ea-11e7-907b-a6006ad3dba0', // E-monsite | Blog
		    'name'                      => 'E-monsite | Blog - Summary',
	    ]);

	    // E-monsite | Blog - Photo
	    SearchUseCasePreset::create([
		    'id'                        => 'd3c73a6c-7767-11e7-b5a5-be2e44b06b34',
		    'data_stream_preset_id'     => '737441b0-57ea-11e7-907b-a6006ad3dba0', // E-monsite | Blog
		    'name'                      => 'E-monsite | Blog - Photo',
	    ]);
    }
}
