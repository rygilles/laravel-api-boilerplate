<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataStreamPresetFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('data_stream_preset_field', function (Blueprint $table) {
		    $table->uuid('id');
		    $table->uuid('data_stream_preset_id')->index();
		    $table->string('name', 200);
		    $table->text('path');
		    $table->boolean('versioned');
		    $table->boolean('searchable');
		    $table->boolean('to_retrieve');
		    $table->timestamps();
		    $table->primary('id');
	    });

	    Schema::table('data_stream_preset_field', function (Blueprint $table) {
		    $table->foreign('data_stream_preset_id')->references('id')->on('data_stream_preset');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_stream_preset_field');
    }
}
