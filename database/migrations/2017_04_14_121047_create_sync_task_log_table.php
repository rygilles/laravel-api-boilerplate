<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSyncTaskLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sync_task_log', function (Blueprint $table) {
	        $table->uuid('id');
	        $table->string('sync_task_status_id', 50)->index();
	        $table->uuid('sync_task_id')->index();
	        $table->text('entry');
	        $table->boolean('public')->default(false);
	        $table->timestamps();
	        $table->primary('id');
        });

	    Schema::table('sync_task_log', function (Blueprint $table) {
		    $table->foreign('sync_task_status_id')->references('id')->on('sync_task_status');
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
        Schema::dropIfExists('sync_task_log');
    }
}
