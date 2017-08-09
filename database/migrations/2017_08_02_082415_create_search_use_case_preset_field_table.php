<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchUseCasePresetFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('search_use_case_preset_field', function (Blueprint $table) {
		    $table->uuid('search_use_case_preset_id')->index();
		    $table->uuid('data_stream_preset_field_id')->index();
		    $table->string('name', 200);
		    $table->boolean('searchable');
		    $table->boolean('to_retrieve');
		    $table->timestamps();
	    });

	    Schema::table('search_use_case_preset_field', function (Blueprint $table) {
		    $table->primary(['search_use_case_preset_id', 'data_stream_preset_field_id'], 'search_use_case_preset_field_primary');
	    });

	    Schema::table('search_use_case_preset_field', function (Blueprint $table) {
		    $table->foreign('search_use_case_preset_id')->references('id')->on('search_use_case_preset');
		    $table->foreign('data_stream_preset_field_id')->references('id')->on('data_stream_preset_field');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('search_use_case_preset_field');
    }
}
