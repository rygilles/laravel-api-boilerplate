<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserHasProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_has_project', function (Blueprint $table) {
            $table->uuid('user_id')->
                    index()->
                    references('id')->on('user');
            $table->uuid('project_id')->
                    index()->
                    references('id')->on('project');
            $table->string('user_role_id', 30)->
                    index()->
                    references('id')->on('user_role');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_has_project');
    }
}
