<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataStreamHasI18nLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_stream_has_i18n_lang', function (Blueprint $table) {
            $table->uuid('data_stream_id')->index();
            $table->string('i18n_lang_id', 30)->index();
            $table->timestamps();
        });

        Schema::table('data_stream_has_i18n_lang', function (Blueprint $table) {
            $table->primary(['data_stream_id', 'i18n_lang_id']);
        });

        Schema::table('data_stream_has_i18n_lang', function (Blueprint $table) {
            $table->foreign('data_stream_id')->references('id')->on('data_stream');
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
        Schema::dropIfExists('data_stream_has_i18n_lang');
    }
}
