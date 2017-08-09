<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('widget', function (Blueprint $table) {
		    $table->uuid('id');
		    $table->uuid('search_use_case_id')->index();
		    $table->string('name', 200);
		    $table->timestamps();
		    $table->primary('id');
	    });

	    Schema::table('widget', function (Blueprint $table) {
		    $table->foreign('search_use_case_id')->references('id')->on('search_use_case');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('widget');
    }
}
