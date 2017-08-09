<?php

use App\Models\WidgetPreset;
use Illuminate\Database\Seeder;

class WidgetPresetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    // E-monsite | Blog - Summary widget preset

	    WidgetPreset::create([
		    'id'                            => '6be0a102-7769-11e7-b5a5-be2e44b06b34',
		    'search_use_case_preset_id'     => '516f0252-7767-11e7-b5a5-be2e44b06b34',
		    'name'                          => 'E-monsite | Blog - Summary Widget',
	    ]);

	    // E-monsite | Blog - Photo widget preset

	    WidgetPreset::create([
		    'id'                            => '0f85eb82-776a-11e7-b5a5-be2e44b06b34',
		    'search_use_case_preset_id'     => 'd3c73a6c-7767-11e7-b5a5-be2e44b06b34',
		    'name'                          => 'E-monsite | Blog - Photo Widget',
	    ]);
    }
}
