<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user', function (Blueprint $table) {
			$table->uuid('id');
			$table->string('name', 100);
			$table->string('email', 150)->unique();
			$table->string('password', 150);
			$table->string('preferred_language', 30)->nullable();
			$table->rememberToken();
			$table->timestamp('confirmed_at')->nullable();
			$table->string('confirmation_token', 64)->nullable();
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
		Schema::dropIfExists('user');
	}
}
