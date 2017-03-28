<?php

use Illuminate\Database\Seeder;
use App\Models\SearchEngine;

class SearchEngineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SearchEngine::create([
            'id'        => 'ee87e3b2-1388-11e7-93ae-92361f002671',
            'name'      => 'Algolia'
        ]);
    }
}
