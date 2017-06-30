<?php

use App\Models\DataStreamPresetField;
use Illuminate\Database\Seeder;

class DataStreamPresetFieldTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    // E-monsite | Blog fields

	    DataStreamPresetField::create([
		    'id'                        => 'eb9cb642-5bf3-11e7-907b-a6006ad3dba0',
		    'data_stream_preset_id'     => '737441b0-57ea-11e7-907b-a6006ad3dba0', // Emonsite | Blog
		    'name'                      => 'title',
		    'path'                      => 'title',
		    'versioned'                 => true,
		    'searchable'                => true,
		    'to_retrieve'               => true,
	    ]);

	    DataStreamPresetField::create([
		    'id'                        => 'eb9cba20-5bf3-11e7-907b-a6006ad3dba0',
		    'data_stream_preset_id'     => '737441b0-57ea-11e7-907b-a6006ad3dba0', // Emonsite | Blog
		    'name'                      => 'content',
		    'path'                      => 'content',
		    'versioned'                 => true,
		    'searchable'                => true,
		    'to_retrieve'               => true,
	    ]);

	    DataStreamPresetField::create([
		    'id'                        => 'eb9cc15a-5bf3-11e7-907b-a6006ad3dba0',
		    'data_stream_preset_id'     => '737441b0-57ea-11e7-907b-a6006ad3dba0', // Emonsite | Blog
		    'name'                      => 'seo_keywords',
		    'path'                      => 'seo_keywords',
		    'versioned'                 => true,
		    'searchable'                => true,
		    'to_retrieve'               => true,
	    ]);

	    DataStreamPresetField::create([
		    'id'                        => 'eb9cc34e-5bf3-11e7-907b-a6006ad3dba0',
		    'data_stream_preset_id'     => '737441b0-57ea-11e7-907b-a6006ad3dba0', // Emonsite | Blog
		    'name'                      => 'seo_description',
		    'path'                      => 'seo_description',
		    'versioned'                 => true,
		    'searchable'                => true,
		    'to_retrieve'               => true,
	    ]);

	    DataStreamPresetField::create([
		    'id'                        => 'eb9cc4ca-5bf3-11e7-907b-a6006ad3dba0',
		    'data_stream_preset_id'     => '737441b0-57ea-11e7-907b-a6006ad3dba0', // Emonsite | Blog
		    'name'                      => 'tags',
		    'path'                      => 'tags',
		    'versioned'                 => true,
		    'searchable'                => true,
		    'to_retrieve'               => true,
	    ]);

	    DataStreamPresetField::create([
		    'id'                        => 'eb9cc650-5bf3-11e7-907b-a6006ad3dba0',
		    'data_stream_preset_id'     => '737441b0-57ea-11e7-907b-a6006ad3dba0', // Emonsite | Blog
		    'name'                      => 'breadcrumb',
		    'path'                      => 'breadcrumb',
		    'versioned'                 => true,
		    'searchable'                => true,
		    'to_retrieve'               => true,
	    ]);

	    DataStreamPresetField::create([
		    'id'                        => 'eb9cc7c2-5bf3-11e7-907b-a6006ad3dba0',
		    'data_stream_preset_id'     => '737441b0-57ea-11e7-907b-a6006ad3dba0', // Emonsite | Blog
		    'name'                      => 'url',
		    'path'                      => 'url',
		    'versioned'                 => true,
		    'searchable'                => false,
		    'to_retrieve'               => true,
	    ]);

	    DataStreamPresetField::create([
		    'id'                        => 'eb9cc92a-5bf3-11e7-907b-a6006ad3dba0',
		    'data_stream_preset_id'     => '737441b0-57ea-11e7-907b-a6006ad3dba0', // Emonsite | Blog
		    'name'                      => 'seo_image_url',
		    'path'                      => 'seo_image_url',
		    'versioned'                 => true,
		    'searchable'                => false,
		    'to_retrieve'               => true,
	    ]);

	    DataStreamPresetField::create([
		    'id'                        => 'eb9ccec0-5bf3-11e7-907b-a6006ad3dba0',
		    'data_stream_preset_id'     => '737441b0-57ea-11e7-907b-a6006ad3dba0', // Emonsite | Blog
		    'name'                      => 'author',
		    'path'                      => 'author',
		    'versioned'                 => false,
		    'searchable'                => true,
		    'to_retrieve'               => true,
	    ]);

	    DataStreamPresetField::create([
		    'id'                        => 'eb9cd14a-5bf3-11e7-907b-a6006ad3dba0',
		    'data_stream_preset_id'     => '737441b0-57ea-11e7-907b-a6006ad3dba0', // Emonsite | Blog
		    'name'                      => 'rating_count',
		    'path'                      => 'rating_count',
		    'versioned'                 => false,
		    'searchable'                => false,
		    'to_retrieve'               => true,
	    ]);

	    DataStreamPresetField::create([
		    'id'                        => '76952b58-5bf4-11e7-907b-a6006ad3dba0',
		    'data_stream_preset_id'     => '737441b0-57ea-11e7-907b-a6006ad3dba0', // Emonsite | Blog
		    'name'                      => 'rating_avg',
		    'path'                      => 'rating_avg',
		    'versioned'                 => false,
		    'searchable'                => false,
		    'to_retrieve'               => true,
	    ]);
    }
}
