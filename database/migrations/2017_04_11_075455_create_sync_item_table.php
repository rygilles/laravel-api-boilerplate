<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSyncItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sync_item', function (Blueprint $table) {
            $table->string('item_id', 191)->index();
	        $table->uuid('project_id')->index();
            $table->string('item_signature', 32);
            $table->timestamps();
        });

	    Schema::table('sync_item', function (Blueprint $table) {
		    $table->primary(['item_id', 'project_id']);
	    });

	    Schema::table('sync_item', function (Blueprint $table) {
		    $table->foreign('project_id')->references('id')->on('project');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sync_item');
    }
}
