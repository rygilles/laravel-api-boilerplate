<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSyncTaskTypeVTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sync_task_type_v', function (Blueprint $table) {
	        $table->string('sync_task_type_id', 50)->index();
	        $table->string('i18n_lang_id', 30)->index();
            $table->text('description');
            $table->timestamps();
        });

	    Schema::table('sync_task_type_v', function (Blueprint $table) {
		    $table->primary(['sync_task_type_id', 'i18n_lang_id']);
	    });

	    Schema::table('sync_task_type_v', function (Blueprint $table) {
		    $table->foreign('sync_task_type_id')->references('id')->on('sync_task_type');
		    $table->foreign('i18n_lang_id')->references('id')->on('i18n_lang');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sync_task_type_v');
    }
}
