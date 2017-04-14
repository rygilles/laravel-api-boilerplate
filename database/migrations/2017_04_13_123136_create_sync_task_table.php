<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSyncTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sync_task', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('sync_task_id', 50)->nullable()->index();
	        $table->string('sync_task_type_id', 50)->index();
	        $table->string('sync_task_status_id', 50)->index();
            $table->uuid('created_by_user_id')->nullable()->index();
	        $table->uuid('project_id')->index();
            $table->timestamps();
            $table->primary('id');
        });

	    Schema::table('sync_task', function (Blueprint $table) {
		    $table->foreign('sync_task_id')->references('id')->on('sync_task');
		    $table->foreign('sync_task_type_id')->references('id')->on('sync_task_type');
		    $table->foreign('sync_task_status_id')->references('id')->on('sync_task_status');
		    $table->foreign('created_by_user_id')->references('id')->on('user');
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
        Schema::dropIfExists('sync_task');
    }
}
