<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchUseCaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_use_case', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('project_id')->index();
            $table->string('name', 200);
            $table->timestamps();
            $table->primary('id');
        });

        Schema::table('search_use_case', function (Blueprint $table) {
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
        Schema::dropIfExists('search_use_case');
    }
}
