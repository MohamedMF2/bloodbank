<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('email')->unique();
			$table->date('birth_date');
			$table->integer('blood_type_id');
			$table->string('phone')->unique();
			$table->string('password');
			$table->tinyInteger('activated');
			$table->string('api_token',60)->unique()->nullable();
			$table->integer('city_id');
			$table->date('date_of_last_donation');
			$table->integer('pin_code')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}