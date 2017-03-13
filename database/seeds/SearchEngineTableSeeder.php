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
            'name'      => 'Algolia'
        ]);
    }
}
