<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSyncTaskItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('sync_task_item', function (Blueprint $table) {
		    $table->string('item_id', 191)->index();
		    $table->uuid('sync_task_id')->index();
		    $table->mediumText('data')->nullable();
		    $table->string('item_signature', 32)->nullable();
		    $table->timestamps();
	    });

	    Schema::table('sync_task_item', function (Blueprint $table) {
		    $table->primary(['item_id', 'sync_task_id']);
	    });

	    Schema::table('sync_task_item', function (Blueprint $table) {
		    $table->foreign('sync_task_id')->references('id')->on('sync_task');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sync_task_item');
    }
}
