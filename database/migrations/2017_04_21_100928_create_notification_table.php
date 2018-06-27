<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notification', function (Blueprint $table) {
			$table->uuid('id')->primary();
			$table->string('type');

			// Create custom polymorphic table columns with UUID instead of using table->morphs method (use auto inc. id)
			// $table->morphs('notifiable');
			$table->uuid('notifiable_id');
			$table->string('notifiable_type');
			$table->index(['notifiable_id', 'notifiable_type']);

			$table->text('data');
			$table->timestamp('read_at')->nullable();
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
		Schema::dropIfExists('notification');
	}
}
