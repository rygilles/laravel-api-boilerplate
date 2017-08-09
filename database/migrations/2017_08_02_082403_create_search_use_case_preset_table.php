<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchUseCasePresetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_use_case_preset', function (Blueprint $table) {
	        $table->uuid('id');
	        $table->uuid('data_stream_preset_id')->index();
	        $table->string('name', 200);
	        $table->timestamps();
	        $table->primary('id');
        });

        Schema::table('search_use_case_preset', function (Blueprint $table) {
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
        Schema::dropIfExists('search_use_case_preset');
    }
}
