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
            $table->uuid('user_id')->index();
            $table->uuid('project_id')->index();
            $table->string('user_role_id', 30)->index();
            $table->timestamps();
        });

        Schema::table('user_has_project', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('project_id')->references('id')->on('project');
            $table->foreign('user_role_id')->references('id')->on('user_role');
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
