<?php

use App\Models\Widget;
use Illuminate\Database\Seeder;

class WidgetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    Widget::create([
		    'id'                    => 'a2fb4304-781d-11e7-b5a5-be2e44b06b34',
		    'search_use_case_id'    => '37f79df8-707c-11e7-8cf7-a6006ad3dba0', // John Smith Sample Project Default Search Use Case
		    'name'                  => 'E-monsite | Blog - Summary Widget',
	    ]);

	    // E-monsite | Blog - Photo widget preset

	    Widget::create([
		    'id'                     => 'b070b438-781d-11e7-b5a5-be2e44b06b34',
		    'search_use_case_id'     => 'dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0', // Mickey Mouse Sample Project Default Search Use Case
		    'name'                   => 'E-monsite | Blog - Photo Widget',
	    ]);
    }
}
