<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataStreamDecoderFeature extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create data_stream_decoder table
	    Schema::create('data_stream_decoder', function (Blueprint $table) {
		    $table->uuid('id');
		    $table->string('name', 200)->index();
		    $table->string('class_name', 100);
		    $table->string('file_mime_type', 255);
		    $table->timestamps();
		    $table->primary('id');
	    });

	    // Update data_stream table
	    Schema::table('data_stream', function (Blueprint $table) {
		    $table->uuid('data_stream_decoder_id')->after('id');
		    $table->foreign('data_stream_decoder_id')->references('id')->on('data_stream_decoder');
	    });

	    // Update data_stream_preset table
	    Schema::table('data_stream_preset', function (Blueprint $table) {
		    $table->uuid('data_stream_decoder_id')->after('id');
		    $table->foreign('data_stream_decoder_id')->references('id')->on('data_stream_decoder');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    // Update data_stream table
	    Schema::table('data_stream', function (Blueprint $table) {
		    $table->dropForeign('data_stream_data_stream_decoder_id_foreign');
		    $table->dropColumn('data_stream_decoder_id');
	    });

	    // Update data_stream_preset table
	    Schema::table('data_stream_preset', function (Blueprint $table) {
		    $table->dropForeign('data_stream_preset_data_stream_decoder_id_foreign');
		    $table->dropColumn('data_stream_decoder_id');
	    });

        Schema::dropIfExists('data_stream_decoder');
    }
}
