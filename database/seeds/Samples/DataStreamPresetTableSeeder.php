<?php

use App\Models\DataStreamPreset;
use Illuminate\Database\Seeder;

class DataStreamPresetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{
		// E-monsite | Blog
		DataStreamPreset::create([
			'id'                        => '737441b0-57ea-11e7-907b-a6006ad3dba0',
			'data_stream_decoder_id'    => '53fd5290-5a4c-11e7-907b-a6006ad3dba0', // Emonsite | Blog
			'name'                      => 'E-monsite | Blog',
		]);
	}
}
