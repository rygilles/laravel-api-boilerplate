<?php

use App\Models\DataStreamField;
use Illuminate\Database\Seeder;

class DataStreamFieldTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Mickey Mouse Sample Project Data Stream fields

        DataStreamField::create([
            'id'                        => '36116fa6-5c0d-11e7-907b-a6006ad3dba0',
            'data_stream_id'            => '605d712c-1934-11e7-93ae-92361f002671', // Mickey Mouse Sample Project
            'name'                      => 'title',
            'path'                      => 'title',
            'versioned'                 => true,
            'searchable'                => true,
            'to_retrieve'               => true,
        ]);

        DataStreamField::create([
            'id'                        => '36117334-5c0d-11e7-907b-a6006ad3dba0',
            'data_stream_id'            => '605d712c-1934-11e7-93ae-92361f002671', // Mickey Mouse Sample Project
            'name'                      => 'content',
            'path'                      => 'content',
            'versioned'                 => true,
            'searchable'                => true,
            'to_retrieve'               => true,
        ]);

        DataStreamField::create([
            'id'                        => '361174ce-5c0d-11e7-907b-a6006ad3dba0',
            'data_stream_id'            => '605d712c-1934-11e7-93ae-92361f002671', // Mickey Mouse Sample Project
            'name'                      => 'seo_keywords',
            'path'                      => 'seo_keywords',
            'versioned'                 => true,
            'searchable'                => true,
            'to_retrieve'               => true,
        ]);

        DataStreamField::create([
            'id'                        => '3611764a-5c0d-11e7-907b-a6006ad3dba0',
            'data_stream_id'            => '605d712c-1934-11e7-93ae-92361f002671', // Mickey Mouse Sample Project
            'name'                      => 'seo_description',
            'path'                      => 'seo_description',
            'versioned'                 => true,
            'searchable'                => true,
            'to_retrieve'               => true,
        ]);

        DataStreamField::create([
            'id'                        => '36117d3e-5c0d-11e7-907b-a6006ad3dba0',
            'data_stream_id'            => '605d712c-1934-11e7-93ae-92361f002671', // Mickey Mouse Sample Project
            'name'                      => 'tags',
            'path'                      => 'tags',
            'versioned'                 => true,
            'searchable'                => true,
            'to_retrieve'               => true,
        ]);

        DataStreamField::create([
            'id'                        => '36117f14-5c0d-11e7-907b-a6006ad3dba0',
            'data_stream_id'            => '605d712c-1934-11e7-93ae-92361f002671', // Mickey Mouse Sample Project
            'name'                      => 'breadcrumb',
            'path'                      => 'breadcrumb',
            'versioned'                 => true,
            'searchable'                => true,
            'to_retrieve'               => true,
        ]);

        DataStreamField::create([
            'id'                        => '36118072-5c0d-11e7-907b-a6006ad3dba0',
            'data_stream_id'            => '605d712c-1934-11e7-93ae-92361f002671', // Mickey Mouse Sample Project
            'name'                      => 'url',
            'path'                      => 'url',
            'versioned'                 => true,
            'searchable'                => false,
            'to_retrieve'               => true,
        ]);

        DataStreamField::create([
            'id'                        => '361181d0-5c0d-11e7-907b-a6006ad3dba0',
            'data_stream_id'            => '605d712c-1934-11e7-93ae-92361f002671', // Mickey Mouse Sample Project
            'name'                      => 'seo_image_url',
            'path'                      => 'seo_image_url',
            'versioned'                 => true,
            'searchable'                => false,
            'to_retrieve'               => true,
        ]);

        DataStreamField::create([
            'id'                        => '361183ba-5c0d-11e7-907b-a6006ad3dba0',
            'data_stream_id'            => '605d712c-1934-11e7-93ae-92361f002671', // Mickey Mouse Sample Project
            'name'                      => 'author',
            'path'                      => 'author',
            'versioned'                 => false,
            'searchable'                => true,
            'to_retrieve'               => true,
        ]);

        DataStreamField::create([
            'id'                        => '36118536-5c0d-11e7-907b-a6006ad3dba0',
            'data_stream_id'            => '605d712c-1934-11e7-93ae-92361f002671', // Mickey Mouse Sample Project
            'name'                      => 'rating_count',
            'path'                      => 'rating_count',
            'versioned'                 => false,
            'searchable'                => false,
            'to_retrieve'               => true,
        ]);

        DataStreamField::create([
            'id'                        => '361186a8-5c0d-11e7-907b-a6006ad3dba0',
            'data_stream_id'            => '605d712c-1934-11e7-93ae-92361f002671', // Mickey Mouse Sample Project
            'name'                      => 'rating_avg',
            'path'                      => 'rating_avg',
            'versioned'                 => false,
            'searchable'                => false,
            'to_retrieve'               => true,
        ]);
    }
}
