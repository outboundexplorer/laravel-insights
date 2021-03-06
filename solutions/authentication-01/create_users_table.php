<?php
// app/database/migrations/create_users_table.php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
            		$table->string('email',50)->unique();
            		$table->string('username',20);
            		$table->string('password',60);
            		$table->string('password_temp',60);
            		$table->string('code',60);
            		$table->tinyInteger('active');
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
		Schema::drop('users');
	}

}
