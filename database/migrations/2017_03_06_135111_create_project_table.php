<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('search_engine_id')->
	                index()->
                    references('id')->on('search_engine');
            $table->uuid('data_stream_id')->
                    nullable()->
                    index()->
                    references('id')->on('data_stream');
            $table->string('name', 100);
            $table->timestamps();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project');
    }
}
