<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserTableWithUserGroupId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user', function (Blueprint $table) {
            // Temporary nullable (sqlite fix for test purpose)
            $table->string('user_group_id', 30)->nullable()->after('id');
            $table->foreign('user_group_id')->references('id')->on('user_group');
        });

        Schema::table('user', function (Blueprint $table) {
            // Temporary nullable (sqlite fix for test purpose)
            $table->string('user_group_id', 30)->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropForeign('user_user_group_id_foreign');
            $table->dropcolumn('user_group_id');
        });
    }
}
