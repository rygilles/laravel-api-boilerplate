<?php

use App\Models\DataStreamDecoder;
use Illuminate\Database\Seeder;

class DataStreamDecoderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DataStreamDecoder::create([
            'id'                => '53fd5290-5a4c-11e7-907b-a6006ad3dba0',
            'name'              => 'Emonsite',
	        'class_name'        => 'EmonsiteDecoder',
            'file_mime_type'    => 'application/json',
        ]);
    }
}
